<?php

namespace App\Http\Controllers;

use App\User;
use App\Account;
use App\PaymentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function vk(Request $request) {
        if ($request->code == null)
            return redirect()->route('login');

        $app = [
            'client_id' => 7264964,
            'client_secret' => 'Paxj1kJGTfzRl8lYADsO',
            'code' => $request->code,
            'redirect_uri' => 'https://klaufshop.ru/vk'
        ]; 
        
        $token = json_decode(file_get_contents('https://oauth.vk.com/access_token?'.urldecode(http_build_query($app))));
        $data = json_decode(file_get_contents('https://api.vk.com/method/users.get?access_token='.$token->access_token.'&v=5.103&user_id='.$token->user_id.'&fields=uid,first_name,last_name,photo_100'), true);

        $cookie = [cookie('token', $token->access_token, $token->expires_in / 60),
                    cookie('user', $token->user_id, $token->expires_in / 60)];

        if(!Auth::check()) {
            $d = $data['response'][0];
            $user = User::where('name', $d['id'])->first();
            if(isset($user->id))
                Auth::loginUsingId($user->id, true);
            else {
                $ref = null;
                if ($request->cookie('ref') !== null)
                    $ref = User::where('name', $request->cookie('ref'))->first()->id;
                $newUser = User::create([
                    'avatar' => $d['photo_100'],
                    'name' => $d['id'],
                    'referral' => $ref != null ? $ref : null,
                ]);
                Auth::loginUsingId($newUser->id, true);
            }
        }
        return redirect()->route('home')->cookie($cookie[0])->cookie($cookie[1]);
    }

    public function profile() {   
        $cases = Auth::user()->getedItems()->orderBy('id', 'desc')->get();
        $items = Auth::user()->boughtItems()->orderBy('id', 'desc')->get();

        $all = $items->merge($cases);
        $all->sortByDesc('updated_at');
        
        return view('profile.index', [
            'items' => $all,
        ]);
    }

    public function payment() {
        $items = Auth::user()->boughtItems()->get();
        $cases = Auth::user()->getedItems()->get();
        $payments = PaymentHistory::where('user_id', Auth::user()->id)->where('isPayed', 1)->take(10)->get();
        
        $all = collect([$items->all(), $cases->all(), $payments->all()]);
        $all->sortByDesc('updated_at');

        return view('payments', [
            'items' => $all->collapse(),
        ]);
    }

    public function pay(Request $request) {
        $his = PaymentHistory::find($request->MERCHANT_ORDER_ID);

        if(!$his->isPayed) {
            $user = $his->getUser;
            $user->money = $user->money + $his->amount;
            $user->save();
            
            $userRef = $user->referralUser;
            if ($userRef != null && $userRef->id == 14) {
                $userRef->money = $userRef->money + 0.2 * $his->amount;
                $userRef->save();
            }
        }

        $his->isPayed = true;
        $his->save();

        return redirect()->route('payment');
    }

    public function c_pay(Request $request) {
        $ph = PaymentHistory::create([
            'user_id' => Auth::user()->id,
            'amount' => abs(floor($request->amount)),
        ]);

        return [md5('179178:'.$request->amount.':7shces5t:'.$ph->id), $ph->id];
    }
}

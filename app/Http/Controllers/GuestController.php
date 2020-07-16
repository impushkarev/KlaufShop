<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Account;
use App\User;
use App\Cases;
use App\CasePrizeList;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;

class GuestController extends Controller
{
    public function index() {
        return view('index');
    }

    public function accounts() {
        $clashofclans = Account::whereNull('boughtBy')->where('game', 'clash-of-clans')->take(8)->orderBy('id', 'desc')->get();
        $clashroyal = Account::whereNull('boughtBy')->where('game', 'clash-royal')->take(8)->orderBy('id', 'desc')->get();
        $brawlstars = Account::whereNull('boughtBy')->where('game', 'brawl-stars')->take(8)->orderBy('id', 'desc')->get();

        return view('accounts', [
            'items_coc' => $clashofclans,
            'items_cr' => $clashroyal,
            'items_bs' => $brawlstars,
        ]);
    }

    public function accounts_game($game) {
        $data = GuestController::check_game($game);
        $items = Account::where('game', $game)->whereNull('boughtBy')->take(8)->orderBy('id', 'desc')->get();

        if ($items->count() == 0)
            return redirect()->route('accounts');

        return view('accounts_game', [
            'game' => $game,
            'name' => $data['name'],
            'items' => $items,
        ]);
    }

    public function accounts_item($game, Account $account) {
        if ($game == $account->game && $account->boughtBy == null)
            return view('accounts_item', [
                'item' => $account,
            ]);
        return redirect()->back();
    }

    public function accounts_buy($game, Account $account) {
        if (Auth::user()->money > $account->price)
        {
            $account->boughtBy = Auth::user()->id;
            $account->save();
            
            Auth::user()->money = Auth::user()->money - $account->price;
            Auth::user()->save();

            $ref = Auth::user()->referralUser;
            if ($ref != null) {
                $ref->money = $ref->money + floor(0.03 * $account->price);
                $ref->save();
            }

            return redirect()->route('profile');
        } 
        return redirect()->back();
    }

    public function cases() {
        $data = $this->case_data();

        $regular = Cases::where('type', 'regular')->get();
        $youtube = Cases::where('type', 'youtube')->get();

        return view('cases', [
            'cases_regular' => $regular,
            'cases_youtube' => $youtube,
            'online' => $data[0],
            'opened' => $data[1],
            'lopened' => $data[2],
        ]);
    }

    public function cases_item(Request $request, Cases $case) {            
        $data = $this->case_data();
        $isAvail = true;
        $isSubscribed = false;
        $isTimeout = false;
        $isEnoughM = false;
        $isLiked = false;
        $post_id = null;

        if (Auth::check() && Auth::user()->money >= $case->price)
            $isEnoughM = true;
        
        if ($case->name == 'Бесплатный' && Auth::check()) {
            $isSubscribed = json_decode(file_get_contents('https://api.vk.com/method/groups.isMember?access_token='.$request->cookie('token').'&group_id=184196774'.'&v=5.52'));
            $wallInfo = json_decode(file_get_contents('https://api.vk.com/method/wall.get?access_token='.$request->cookie('token').'&owner_id=-184196774&count=1&user_id='.$request->cookie('user').'&v=5.52'));
            $post_id = $wallInfo->response->items[0]->id;

            $isLiked = json_decode(file_get_contents('https://api.vk.com/method/likes.isLiked?access_token='.$request->cookie('token').'&type=post&owner_id=-184196774&item_id='.$post_id.'&user_id='.$request->cookie('user').'&v=5.52'));
            $isLiked = $isLiked->response->liked;

            foreach (Auth::user()->getedItems()->whereDate('updated_at', Carbon::today())->get() as $prize)
                if ($prize->getCase->name == 'Бесплатный')
                    $isTimeout = true;
        }

        foreach ($case->prizes as $item) {
            $it = $item->getPrizeList()->whereNull('getBy')->count();  
            if ($it == 0)
                $isAvail = false;
        }

        return view('case', [
            'case' => $case,
            'isAvail' => $isAvail,
            'isSubscribed' => $isSubscribed,
            'isTimeout' => $isTimeout,
            'isEnoughM' => $isEnoughM,
            'isLiked' => $isLiked,
            'post_id' => $post_id,
            'online' => $data[0],
            'opened' => $data[1],
            'lopened' => $data[2],
        ]);
    }

    public function cases_spin(Request $request, Cases $case) {
        if (Auth::user()->money >= $case->price) {
            if ($case->name == 'Бесплатный') {
                $isSubscribed = json_decode(file_get_contents('https://api.vk.com/method/groups.isMember?access_token='.$request->cookie('token').'&group_id=184196774'.'&v=5.52'));
                if (!$isSubscribed)
                    return null;
                    
                $wallInfo = json_decode(file_get_contents('https://api.vk.com/method/wall.get?access_token='.$request->cookie('token').'&owner_id=-184196774&count=1&user_id='.$request->cookie('user').'&v=5.52'));
                $post_id = $wallInfo->response->items[0]->id;
                
                $isLiked = json_decode(file_get_contents('https://api.vk.com/method/likes.isLiked?access_token='.$request->cookie('token').'&type=post&owner_id=-184196774&item_id='.$post_id.'&user_id='.$request->cookie('user').'&v=5.52'));
                $isLiked = $isLiked->response->liked;
                if (!$isLiked)
                    return null;

                foreach (Auth::user()->getedItems()->whereDate('updated_at', Carbon::today())->get() as $prize)
                    if ($prize->getCase->name == 'Бесплатный')
                        return null;
            }
            
            //Текущий пользователь
            $user = Auth::user();

            //Покупка кейса и получить текущее количество денег
            $user->money = $user->money - $case->price;
            $money = $user->money;

            //Получить призы с их вероятностями
            $m = $case->prizes()->sum('chance');
            foreach ($case->prizes as $id => $prize)
                $p[$id] = [$prize->name, $prize->chance / $m];
            
            //Построить прямую вероятностей
            $d[0] = 0;
            for ($i=0; $i < count($p); $i++)
                $d[$i + 1] = (float)$p[$i][1] + (float)$d[$i]; 

            //Найти промежуток в котором находится выйгрыш
            $rnd = mt_rand() / mt_getrandmax();
            for ($i=1; $i < count($d) - 1; $i++) { 
                if($d[$i] > $rnd)
                    break;
                continue;
            }

            //Приз
            $prize = $case->prizes()->where('name', $p[$i - 1][0])->first();
            
            //Выбрать приз который еще никто не получал
            $getedPrize = $prize->getPrizeList()->whereNull('getBy')->first();
            //if ($prize->type != 'accounts')
                //Копировать приз
                $replicated = $getedPrize->replicate()->push();
            //Получить приз
            $getedPrize->getBy = $user->id;
            $getedPrize->save();

            //Если приз валюта сайта, получить ее
            if ($prize->type == 'money')
                $user->money = $user->money + preg_replace('/[^0-9]/', '', $prize->name);

            $user->save();

            return [$prize->name, number_format($money, 2, ',', ' '), $prize->type, number_format($user->money, 2, ',', ' '), $case->name];
        }
        return null;
    }

    public function about() {
        $date = floor((time() - strtotime("21.12.2019")) / (60 * 60 * 24));
        $users = User::count();
        $as = Account::whereNotNull('boughtBy'); 
        $opened = CasePrizeList::whereNotNull('getBy');
        $payed_a = $as->sum('price');
        $payed_c = 0;
        foreach ($opened->get() as $open)
            $payed_c += $open->getCase->price;

        return view('about', [
            'date' => $date,
            'users' => $users,
            'as' => $as->count(),
            'opened' => $opened->count(),
            'payed' => $payed_c + $payed_a
        ]);
    }

    public function faq() {
        return view('faq');
    }

    private function check_game($game) {
        switch ($game) {
            case 'clash-of-clans':
                $data = [
                    'name' => 'Clash of Clans',
                ];
                break;
            case 'clash-royal':
                $data = [
                    'name' => 'Clash Royal',
                ];
                break;
            case 'brawl-stars';
                $data = [
                    'name' => 'Brawl Stars',
                ];
                break;
            default:
                return abort(404);
                break;
        }
        return $data;
    }

    private function case_data() {
        $online = User::where('updated_at', '>', Carbon::parse(time() - 5 * 60))->count();
        $cp = CasePrizeList::whereNotNull('getBy');
        $opened = $cp->count();
        $lopened = $cp->where('updated_at', '>', Carbon::parse(time() - 30 * 60))->count();
        
        return [$online, $opened, $lopened];
    }
}

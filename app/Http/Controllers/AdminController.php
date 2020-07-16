<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Cases;
use Carbon\Carbon;
use App\CasePrizeList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\PaymentHistory;

class AdminController extends Controller
{
    public function admin(Request $request) {
        $accounts = Account::orderBy('id', 'desc')->get();
        $cases = Cases::orderBy('id', 'desc')->get();

        $ph = PaymentHistory::where('isPayed', 1)->whereDate('updated_at', Carbon::today())->orderBy('id', 'desc');
        $sum_ph_td = PaymentHistory::where('isPayed', 1)->orderBy('id', 'desc')->sum('amount');
        
        $checks = CasePrizeList::whereNotNull('getBy')->whereDate('updated_at', Carbon::today())->whereNotBetween('case_prize_id', [95, 100])->where('case_prize_id', '<>', 110)->where('case_prize_id', '<>', 111)->orderBy('updated_at', 'desc')->get();

        return view('admin.index', [
            'accounts' => $accounts,
            'cases' => $cases,
            'payments' => $ph->get(),
            'today_payments_sum' => $sum_ph_td,
            'checks' => $checks,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Order;
use App\Models\Withdraw;
use App\Models\User;
use App\Models\WalletTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HomeController extends Controller
{

    public function index()
    {
        return view('user.index');
    }

    public function accountDetails()
    {
        return view('user.account.details');
    }

    public function accountStatistics()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('/login');
        }
        $totalDeposit = WalletTransactions::where('status', 1)->where('user_id', $user->id)->where('c_type', 1)->where('type', 1)->sum('amount');
        $totalWithdraw = WalletTransactions::where('status', 1)->where('user_id', $user->id)->where('c_type', 1)->where('type', 2)->sum('amount');

        $usdtDeposit = WalletTransactions::where('status', 1)->where('user_id', $user->id)->where('c_type', 2)->where('type', 1)->sum('amount');
        $usdtWithdraw = WalletTransactions::where('status', 1)->where('user_id', $user->id)->where('c_type', 2)->where('type', 2)->sum('amount');
        $usdtPurchase = WalletTransactions::where('status', 1)->where('user_id', $user->id)->where('c_type', 2)->where('type', 3)->sum('amount');

        return view('user.account.statistics', compact('totalDeposit', 'totalWithdraw', 'usdtPurchase', 'usdtDeposit', 'usdtWithdraw'));
    }

    public function walletDeposit()
    {
        return view('user.wallet.deposit');
    }

    public function walletWithdraw()
    {
        return view('user.wallet.withdraw');
    }

    public function walletWithdrawStore(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('/login');
        }

        $this->validate($request, [
            'amount' => 'required',
            'wallet_address' => [
                'required',
                'regex:/^0x[a-fA-F0-9]{40}$/'
            ],
        ]);

        $min_withdraw = getSetting('minimum_withdraw');

        if ($request->amount < $min_withdraw) {
            return back()->withInput($request->input())->withErrors(['error_message' => 'Should be greator than minimum withdraw amount.']);
        }

        if ($request->amount > $user->balance) {
            return back()->withInput($request->input())->withErrors(['error_message' => 'Insufficient balance.']);
        }

        $user = User::findOrFail($user->id);
        $user->balance = $user->balance - $request->amount;
        $user->save();

        $txt = Str::random(20);
        Withdraw::create([
            'amount' => $request->amount,
            'user_id' => Auth::user()->id,
            'wallet_address' => $request->wallet_address,
            'tx_id' => $txt,
        ]);

        WalletTransactions::create([
            'amount' => $request->amount,
            'user_id' => $user->id,
            'tx_id' => $txt,
            'status' => '2',
            'type' => 2,
        ]);

        return redirect()->route('wallet-withdraw')->with('success', 'Withdraw request successfully send.');
    }

    public function walletHistory()
    {
        return view('user.wallet.history');
    }

    public function about()
    {
        return view('user.about');
    }
    
    public function faq()
    {
        return view('user.faq');
    }

    public function publicProfile($id)
    {
        $user = User::where('username', $id)->where('status', 1)->first(); // Use first() instead of get()

        if (!$user) {
            return redirect()->back()->withErrors(['message' => 'User not found']); // Redirect back with error message
        }
        $orders = Order::with(['getProduct'])->where('status', 1)->where('user_id', $user->id)->get();
        $currentDateTime = Carbon::now();
        $total_reward = Order::where('status', 1)
            ->where('user_id', $user->id)
            ->where('fuel_end_time', '>', 0)
            ->where('maintenance_end_time', '>', 0)
            ->selectRaw('SUM(CASE WHEN boost_end_time > 0 THEN (reward_rate * boost_x) ELSE reward_rate END) as total_reward')
            ->value('total_reward');

        return view('user.public-profile', compact('user', 'orders', 'total_reward'));
    }


    public function walletDepositUsdt()
    {
        return view('user.wallet.usdt.deposit');
    }

    public function walletWithdrawUsdt()
    {
        return view('user.wallet.usdt.withdraw');
    }

    public function walletWithdrawStoreUsdt(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('/login');
        }

        $this->validate($request, [
            'amount' => 'required',
            'wallet_address' => [
                'required',
                'regex:/^0x[a-fA-F0-9]{40}$/'
            ],
        ]);

        $min_withdraw = getSetting('usdt_minimum_withdraw');

        if ($request->amount < $min_withdraw) {
            return back()->withInput($request->input())->withErrors(['error_message' => 'Should be greator than minimum withdraw amount.']);
        }

        if ($request->amount > $user->usdt_balance) {
            return back()->withInput($request->input())->withErrors(['error_message' => 'Insufficient balance.']);
        }

        $user = User::findOrFail($user->id);
        $user->usdt_balance = $user->usdt_balance - $request->amount;
        $user->save();

        $txt = Str::random(20);
        Withdraw::create([
            'amount' => $request->amount,
            'user_id' => Auth::user()->id,
            'wallet_address' => $request->wallet_address,
            'c_type' => '2',
            'tx_id' => $txt,
        ]);

        WalletTransactions::create([
            'amount' => $request->amount,
            'user_id' => $user->id,
            'tx_id' => $txt,
            'c_type' => '2',
            'status' => '2',
            'type' => 2,
        ]);

        return redirect()->route('wallet-withdraw')->with('success', 'Withdraw request successfully send.');
    }
}

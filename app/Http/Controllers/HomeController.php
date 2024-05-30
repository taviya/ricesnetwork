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
        return view('welcome');
    }
}

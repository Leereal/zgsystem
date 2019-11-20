<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Claim;
use App\Users;
use App\Client;
use App\Branch;
use App\Payment;
use App\Plan;
use App\ServiceProvider;
use Auth;

class DashboardController extends Controller
{
	$us_this_month = User::whereRaw('MONTH(created_at) = ?',[date('m')])->get();
	return view('home.index',compact('claims_this_month'));
   
}

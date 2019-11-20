<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Carbon\Carbon;
use App\Payment;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //$plans = Plan::where('status',1)->get();
        return view('settings.index');
    }

    public function updateStatus()
    {
        

        //Select all clients membership status 1 (Active) and Count
        $activeClientsDue = Client::where('membership_status',1)->whereHas('payment',function($query){ $query->where([['created_at','>=',(new Carbon('first day of last month'))->addDays(3)],['created_at','<=',(new Carbon('first day of this month'))->addDays(2)]]);})->count();

        //Select all clients in state 1 (Active) and Update to membership status 2
        Client::where('membership_status',1)->whereHas('payment',function($query){ $query->where([['created_at','>=',(new Carbon('first day of last month'))->addDays(3)],['created_at','<=',(new Carbon('first day of this month'))->addDays(2)]]);})->update(['membership_status'=>2]);         

    	$dat3Months = Carbon::now()->subMonth(3);
    	$dat6Months = Carbon::now()->subMonth(6);
        $dat12Months = Carbon::now()->subMonth(12);
        $dat24Months = Carbon::now()->subMonth(24);
    	$count3Months = Client::where([['period_status','=','1'],['created_at','<=',$dat3Months]])->count();
    	$count6Months = Client::whereIn('period_status',[1,2])->where([['created_at','<=',$dat6Months]])->count();
        $count12Months = Client::whereIn('period_status',[1,2,3])->where([['created_at','<=',$dat12Months]])->count();
        $count24Months = Client::whereIn('period_status',[1,2,3,4])->where([['created_at','<=',$dat24Months]])->count();		
        Client::where([['period_status','=','1'],['created_at','<=',$dat3Months]])->update(['period_status' => 2]);
        Client::whereIn('period_status',[1,2])->where([['created_at','<=',$dat6Months]])->update(['period_status' => 3]);
        Client::whereIn('period_status',[1,2,3])->where([['created_at','<=',$dat12Months]])->update(['period_status' => 4]);
        Client::whereIn('period_status',[1,2,3,4])->where([['created_at','<=',$dat24Months]])->update(['period_status' => 5]);

        if($count3Months==0 && $count6Months==0 && $count12Months==0 && $count24Months==0 && $activeClientsDue==0){
        	return redirect('/settings')->with('success','All Records are upto date');
        }
                     
        return redirect('/settings')->with('success',
        $count3Months." Clients Completed Stage 1 Waiting Period,      ".
        $count6Months." Clients Completed Stage 2 Waiting Period,      ".
        $count12Months." Clients Completed Stage 3 Waiting Period,     ".
        $count24Months." Clients Completed Stage 4 Waiting Period,".
        $activeClientsDue."Lapsed Clients. All updates done successfully   "

        );      
    }

    public function backupDb()
    {
    	return redirect('/settings')->with('success','Done successfully');   
    }
}

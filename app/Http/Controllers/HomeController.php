<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;
use App\Client;
use App\Payment;
use App\Claim;
use App\RequestCheck;
use App\ServiceProvider;
use App\MonthlyTarget;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth'=>'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $lastmonth = Carbon::now()->subMonth();
        $start = new Carbon('first day of last month');
        $end = new Carbon('last day of last month');        
        $this_month_first_day = new Carbon('first day of this month');

        //===========Branch Target=============//
        $target = MonthlyTarget::where([['created_at','>=',$this_month_first_day->toDateString()],['branch_id','=',Auth::user()->branch->id]])->first();
        

        //=====Clients Count==================
        $clients = Client::where([['status','=',1],['branch_id','=',Auth::user()->branch->id]])->get();
        $last_month_clients = Client::where([['status','=','1'],['created_at','<=',$lastmonth]])->count(); 
        $active_clients = Client::where([['membership_status','=',1],['status','=',1],['branch_id','=',Auth::user()->branch->id]])->count();            

        //=========Total Payments=============//
        $payments = Payment::where('status',1)->get();
        $overal_last_month_payments = Payment::where([['status','=','1'],['created_at','<=',$lastmonth]])->sum('amount');
        $last_month_payments = Payment::where([['status','=','1'],['created_at','>=',$start],['created_at','<=',$end],['branch_id','=',Auth::user()->branch->id]])->get();
        $this_month_payments = Payment::where([['status','=','1'],['created_at','>=',$this_month_first_day],['branch_id','=',Auth::user()->branch->id]])->sum('amount'); 

        //==========Claims==============//
        $claims = Claim::where('status',1)->get();

        //===========Branch Payment Totals=============//
        $branch_total_payments_last_month = Payment::where([['status','=','1'],['branch_id','=',Auth::user()->branch->id],['created_at','<=',$lastmonth]])->sum('amount');
        $branch_total_payments =$payments->where('branch_id',Auth::user()->branch->id)->sum('amount');

        //==========Service Providers==============//
        $service_providers = ServiceProvider::where('status',1)->get();

        //===========Request from Service Providers==============//
        $requestchecks = RequestCheck::where([['status','=',1],['approved','=',2],['branch_id','=',Auth::user()->branch->id]])->get(); 
        //dd($clients->where(['membership_status','=',1])->count());  

        return view('home',compact('payments','claims','clients','last_month_payments','service_providers','requestchecks','this_month_payments','target','overal_last_month_payments','branch_total_payments_last_month','branch_total_payments','active_clients'));        
    }

    public function lock()
    {
        Artisan::call('down');
        return redirect('home');
    }

     public function help()
    {        
        return view('help');
    }




   
}

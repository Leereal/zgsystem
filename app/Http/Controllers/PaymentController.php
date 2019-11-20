<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Client;
use App\MOP;
use App\Plan;
use Carbon\Carbon;
use Auth;



class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userbranch=Auth::user()->branch->id;
        $mops = MOP::all(); 
        $plans = Plan::all(); 
        
        if($request->plan){

        }   
           
        $payments = Payment::with(['plan', 'branch','mop'])->where([['status', '=', '1'],['branch_id', '=',$userbranch]])->get();        
        return view('payments.index',compact('payments','mops','plans'));
               
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $userbranch=Auth::user()->branch->id;
        $mops = MOP::all();           
        $clients = Client::with(['plan', 'branch'])->where([['status', '=', '1'],['branch_id', '=', $userbranch]])->get();
        return view('payments.create',compact('clients','mops'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, [
                'description'=>'required|min:2',
                'amount'=> 'required|gt:0',                
                'receipt_number'=>'required',                                                
                'plan_id'=>'required',
                'client_id'=>'required',
                'm_o_p_id'=>'required',                              
        ]);
        $rec_num=$request->input('receipt_number');
        $months = $request->input('month_paid_for');
        //$months = implode(',',$months);
        $add = new Payment;        
        $add->description = $request->input('description');
        $add->amount = $request->input('amount');
        $add->plan_id = $request->input('plan_id');
        $add->m_o_p_id = $request->input('m_o_p_id');       
        $add->receipt_number = $request->input('receipt_number');
        $add->ref_number = $request->input('ref_number');
        $add->client_id = $request->input('client_id');
        $add->month_paid_for = $months;
        $add->dop = Carbon::now();
        $add->user_id = Auth::user()->id;
        $add->branch_id = Auth::user()->branch->id;        
        $add->ip_address = $request->getClientIp();
        $add->save();
        return redirect('/payments/receipt/'.$rec_num);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Payment::find($id);
        return view('payments.show')->with('payment',$payment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = Payment::find($id);
        return view('payments.edit')->with('payment',$payment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Payment::find($id)->delete();
        return redirect('/payments')->with('success','Succefully Deleted');
    }

    public function viewClients($id)
    {
        $clients = Client::where('status',1)->get();
        return view('payments.add',compact('clients'));
    }

    public function view($id)
    {
        $payments = Payment::with('client')->where([['status', '=', '1'],['client_id', '=', $id]])->get();
        return view('payments.view',compact('payments'));
    }

    public function receipt($rec_num)
    {

        $payment = Payment::where('receipt_number',$rec_num)->with(['user','client','mop','plan'])->get()->first();
        return view('payments.receipt')->with('payment',$payment);
        //return view('payments.receipt');
    }
    public function reversed()
    {    
        $userbranch=Auth::user()->branch->id;   
        $payments = Payment::with(['plan', 'branch','mop'])->where([['status', '=', '1'],['branch_id', '=',$userbranch]])->onlyTrashed()->get();        
        return view('payments.reversed',compact('payments'));
               
    }



}

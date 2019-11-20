<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Claim;
use App\Client;
use App\Dependent;
use App\RequestCheck;
use App\ServiceProvider;
use App\ClaimCharge;
use App\Tariff;
use Auth;

class ClaimController extends Controller
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
    public function index()
    {
        
        $claims = Claim::where('status',1)->get(); 
        return view('claims.index',compact('claims'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $client = Client::with('plan')->find($id);
        $service_providers = ServiceProvider::where('status',1)->orderBy('name')->get(); 
        $tariffs = Tariff::where('status',1)->orderBy('code')->get();        
        return view('claims.create',compact('client','service_providers','tariffs'));
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
                'amount'=> 'required',
                'tariff'=>'required',
                'pre_authorization_code'=>'nullable|unique:claims,pre_authorization_code', 
                'medical_aid_number'=>'required',
               


        ]);

        $add = new Claim;
        $add->service_provider_id = $request->input('service_provider');
        //$add->total_amount = sum($request->input('amount'));
        $add->pre_authorization_code = $request->input('pre_authorization_code');
        $add->diagnosis = $request->input('diagnosis');       
        $add->claim_number = $request->input('claim_number');
        $add->medical_aid_number = $request->input('medical_aid_number');
        $add->accident = $request->input('accident');
        $add->name_of_referring_practitioner = $request->input('name_of_referring_practitioner');
        $add->referring_practitioner_ahfoz_number = $request->input('referring_practitioner_ahfoz_number');
        $add->name_of_anaesthesist = $request->input('name_of_anaesthesist');
        $add->anaesthesist_ahfoz_number = $request->input('anaesthesist_ahfoz_number');
        $add->name_of_surgical_assistant = $request->input('name_of_surgical_assistant');        
        $add->surgical_assistant_ahfoz_number = $request->input('surgical_assistant_ahfoz_number');
        $add->date_claim_closed = $request->input('date_claim_closed');
        $add->user_id = Auth::user()->id;        
        $add->branch_id = Auth::user()->branch->id;
        $add->ip_address = $request->getClientIp();        
        $add->save();

         // if($add->save()){

         //    // $amount = $request->input('amount');
         //    // $quantity = $request->input('quantity');
         //    // $mods = $request->input('mods');
         //    // $yr_mn = $request->input('year_month'); 
         //    // $days = $request->input('days');
         //    // $tariff = $request->input('tariff');
         //    // for ($count=0; $count < count($firstname); $count++) { 
         //    //     $data = array(
         //    //     'amount'=>$amount[$count],
         //    //     'quantity'=>$quantity[$count],
         //    //     'mods'=>$mods[$count],
         //    //     'yr_mn'=>$yr_mn[$count],
         //    //     'days'=>$days[$count],
         //    //     'tariff_id'=>$tariff
         //    //     );
         //    //     $insert_data[]=$data;
         //    // }

         //    //Add Claim Charges
           
         //    foreach($request->input('tariff') as $tar)
         //    {
         //         $addCharge = new ClaimCharge;
         //        $addCharge->amount = $request->input('amount');
         //        $addCharge->quantity = $request->input('quantity'); 
         //        $addCharge->mods = $request->input('mods');
         //        //$addCharge->description = $request->input('description');
         //        $addCharge->yr_mn = $request->input('year_month');            
         //        $addCharge->days = $request->input('days');
         //        $addCharge->tariff_id = $request->input('tariff');            
         //        $add->claim_charges()->save($addCharge);

         //    }
            
        //}

        return redirect('/claims/')->with('success','Claim Submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $claims = Claim::find($id);
        return view('claims.show')->with('claims',$claims);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $claims = Claim::find($id);
        return view('claims.edit')->with('claims',$claims);
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
        Claim::find($id)->delete();
        return redirect('/claims')->with('success','Succefully Deleted');
    }

     public function viewclients()
    {
        
        $clients = Client::with('plan')->get();        
        return view('claims.view',compact('clients'));
    }
    public function requestCheckDependent($id)
    {
        
        $dependent = Dependent::find($id);

        $check = new RequestCheck;

        $check->dependent_id = $id;
        $check->service_provider_id = Auth::user()->id;
        $check->medical_aid_number = $dependent->medical_aid_number;
        $check->branch_id = $dependent->branch_id;
        $check->save();
        return redirect('clients/dependents/'.$id.'/profile')->with('success','Request Send Successfully');

    }
    public function requestCheckClient($id)
    {
       $client = Client::find($id);

        $check = new RequestCheck;

        $check->client_id = $id;
        $check->service_provider_id = Auth::user()->id;
        $check->medical_aid_number = $client->medical_aid_number;
        $check->branch_id = $client->branch_id;
        $check->save();
        return redirect('clients/'.$id)->with('success','Request Send Successfully');
    }
}

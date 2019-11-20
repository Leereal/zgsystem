<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Plan;
use Auth;
use Carbon\Carbon;
use App\Branch;
use App\Payment;
use App\Activity;
use App\Limit;
use App\Group;
use App\Dependent;
use App\File;
use App\WaitingPeriod;

class ClientController extends Controller
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

        $clients = Client::with(['plan', 'branch','user'])->where([['status', '=', '1']])->with('dependents')->withCount('dependents')->get();       
        //return view('clients.index',compact('clients'));
        return json_encode($clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plans = Plan::where('status',1)->orderBy('name')->get();
        $groups = Group::where('status',1)->orderBy('name')->get(); 
        return view('clients.create',compact('plans','groups'));
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
                'title'=> 'required|min:2',
                'name'=> 'required|min:2',
                'surname'=> 'required|min:2',
                'id_number'=> 'min:2|nullable|unique:clients,id_number', 
                'cellphone'=> 'min:10|nullable|max:10', 
                'email'=>'email|min:2|nullable',                
                'date_of_birth'=> 'date|min:2|nullable',
                'address'=> 'min:2|nullable',
                'gender'=> 'min:2|required',
                'home_telephone'=> 'min:2|nullable',
                'business_telephone'=> 'min:2|nullable',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:8000',
                'bank'=> 'min:2|nullable', 
                'branch'=> 'min:2|nullable',
                'branch_code'=> 'min:2|nullable',
                'account_number'=> 'min:2|nullable',
                'other'=> 'min:2|nullable',
                'doc_address'=> 'min:2|nullable',
                'ecocash'=> 'min:10|nullable|max:10',
                'telecash'=> 'min:10|nullable|max:10',
                'netcash'=> 'min:10|nullable|max:10',
        ]); 

        $path='';
        if($request->hasFile('image')->isValid())
        {
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $imageName); 
            $path = 'images/'.$imageName;   
        }
        

        //Generate Medical Aid Number
        $plans = Plan::find($request->input('plan'));
        $id=$request->input('plan');
        $pre= $plans->pre;
        $last_number=$plans->last_number;
        $num = $last_number+1; 
        $new_number=sprintf("%05d", $num);
        $medical_aid_number=$pre.$new_number.'01';
        $premium=$plans->premium;

        Plan::where('id', $id)->update(array('last_number' => $new_number));

        $add = new Client;
        $add->name = $request->input('name');
        $add->surname = $request->input('surname');
        $add->id_number = $request->input('id_number');
        $add->date_joined = Carbon::now();       
        $add->medical_aid_number = $medical_aid_number;
        $add->cellphone = $request->input('cellphone');
        $add->email = $request->input('email');
        $add->gender = $request->input('gender');
        $add->home_telephone = $request->input('home_telephone');
        $add->business_telephone = $request->input('business_telephone');        
        $add->address = $request->input('address');
        $add->date_of_birth = $request->input('date_of_birth');
        $add->title = $request->input('title');
        //If corporate use corporate_premium
        if($request->input('group')){
           $add->group_id = $request->input('group');
           $add->premium = $plans->corporate_premium;
           $add->total_premium = $plans->corporate_premium;            
        }
        else{
            $add->premium = $premium;
            $add->total_premium = $premium;
        }
        
        $add->image = $path;

        $add->cancer = $request->input('cancer','No');
        $add->renal_disease = $request->input('renal_disease','No');
        $add->psychiatric_conditions = $request->input('psychiatric_conditions','No');
        $add->cardio_vascular_problems = $request->input('cardio_vascular_problems','No');
        $add->hypertension = $request->input('hypertension','No');
        $add->epilepsy = $request->input('epilepsy','No');
        $add->diabetes = $request->input('diabetes','No');
        $add->leprosy = $request->input('leprosy','No');
        $add->asthma = $request->input('asthma','No');
        $add->other = $request->input('other');
        $add->bank = $request->input('bank');
        $add->branch = $request->input('branch');
        $add->branch_code = $request->input('branch_code');
        $add->account_number = $request->input('account_number');
        $add->doc_address = $request->input('doc_address');
        $add->ecocash = $request->input('ecocash');
        $add->telecash = $request->input('telecash');
        $add->netcash = $request->input('netcash');

        $add->user_id = Auth::user()->id;
        $add->branch_id = Auth::user()->branch->id;
        $add->plan_id = $plans->id;
        if($add->save()){

            //Add limits for client
            $addLimit = new Limit;
            $addLimit->global_limit = $plans->global_limit;
            $addLimit->plan_id = $plans->id;            
            $addLimit->hospitalization = $plans->hospitalization;
            $addLimit->ward_admission = $plans->ward_admission;            
            $addLimit->drugs = $plans->drugs;
            $addLimit->dental = $plans->dental;            
            $addLimit->optical = $plans->optical;
            $addLimit->oncology = $plans->oncology;
            $addLimit->dialysis = $plans->dialysis;
            $addLimit->pathology = $plans->pathology;
            $addLimit->radiology = $plans->radiology;
            $addLimit->maternity = $plans->maternity;
            $addLimit->family_planning = $plans->family_planning;
            $addLimit->prosthesis = $plans->prosthesis;
            $addLimit->physiotherapy = $plans->physiotherapy;
            $addLimit->glucometer = $plans->glucometer;
            $addLimit->funeral_grant = $plans->funeral_grant;
            $add->limit()->save($addLimit);

            //Add Waiting period if client does not have a group
            if(!$request->input('group')){
                $addWaitingPerirod = new WaitingPeriod;
                $addWaitingPerirod->general_service_waiting_period = Carbon::now()->addMonth(3);
                $addWaitingPerirod->spectacles_waiting_period = Carbon::now()->addMonth(9);
                $addWaitingPerirod->hospitalization_waiting_period = Carbon::now()->addMonth(9);
                $addWaitingPerirod->maternity_waiting_period = Carbon::now()->addMonth(12);
                $addWaitingPerirod->dental_waiting_period = Carbon::now()->addMonth(9);
                $addWaitingPerirod->specialist_consultation_waiting_period = Carbon::now()->addMonth(3);
                $addWaitingPerirod->dentures_waiting_period = Carbon::now()->addMonth(15);
                $addWaitingPerirod->ct_scans_waiting_period = Carbon::now()->addMonth(15);
                $addWaitingPerirod->oncology_waiting_period = Carbon::now()->addMonth(27);
                $addWaitingPerirod->dialysis_waiting_period = Carbon::now()->addMonth(27);
                $addWaitingPerirod->prosthesis_waiting_period = Carbon::now()->addMonth(27);
                $add->waiting_period()->save($addWaitingPerirod);
            } 
            ////End           

            if($request->hasFile('docs')){
                $allowedfileExtension=['pdf','jpg','png','docx'];
                //$files = $request->file('docs');
                $client = Client::where('medical_aid_number',$medical_aid_number)->get()->first();
                foreach($request->file('docs') as $file){
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $check=in_array($extension,$allowedfileExtension);                    
                    if($check){                                        
                        File::create([
                            'client_id' => $client->id,
                            'name' => $file->store('documents','public'),
                            'caption'=>$filename,
                            'user_id'=>Auth::user()->id
                            ]);                                               
                    }         
                }
            }
            return redirect('/clients')->with('success','Succefully Saved. Client Medical Aid Number is '.$medical_aid_number);
        }
            return redirect('/clients')->with('error');
        

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        $activities = Activity::all()->where('client_id',$id);
        $payments = $client->payment()->with(['mop','user'])->get();
        $claims = $client->claims()->with('serviceprovider','user')->get();
        $dependents = $client->dependents()->get();
        $files = $client->files()->get();
        $limit = $client->limit()->first();
        $plan = $client->plan()->first();        
        //dd($data->toArray());
        return view('clients.profile',compact('client','payments','activities','dependents','claims','files','limit','plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::with(['plan','branch'])->find($id);
        $plans = Plan::all();
        $groups = Group::all();
        return view('clients.edit',compact('client','plans','groups'));
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
        $this->validate($request, [
                'title'=> 'required|min:2',
                'name'=> 'required|min:2',
                'surname'=> 'required|min:2',
                'id_number'=> 'min:2|required', 
                'cellphone'=> 'min:10|nullable|max:10', 
                'email'=>'email|min:2|nullable',                
                'date_of_birth'=> 'date|min:2|nullable',
                'address'=> 'min:2|nullable',
                'gender'=> 'min:2|required',
                'home_telephone'=> 'min:2|nullable',
                'business_telephone'=> 'min:2|nullable',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:8000',
                'bank'=> 'min:2|nullable', 
                'branch'=> 'min:2|nullable',
                'branch_code'=> 'min:2|nullable',
                'account_number'=> 'min:2|nullable',
                'other'=> 'min:2|nullable',
                'doc_address'=> 'min:2|nullable',
                'ecocash'=> 'min:10|nullable|max:10',
                'telecash'=> 'min:10|nullable|max:10',
                'netcash'=> 'min:10|nullable|max:10',
        ]); 
        //Generate Medical Aid Number
        $plans = Plan::find($request->input('plan'));        
        $premium=$plans->premium;

        $add = Client::find($id);
        $add->name = $request->input('name');
        $add->surname = $request->input('surname');
        $add->id_number = $request->input('id_number');
        $add->cellphone = $request->input('cellphone');
        $add->email = $request->input('email');
        $add->gender = $request->input('gender');
        $add->home_telephone = $request->input('home_telephone');
        $add->business_telephone = $request->input('business_telephone');       
        $add->address = $request->input('address');
        $add->date_of_birth = $request->input('date_of_birth');
        $add->title = $request->input('title');
        $add->premium = $premium; 

        $add->cancer = $request->input('cancer','No');
        $add->renal_disease = $request->input('renal_disease','No');
        $add->psychiatric_conditions = $request->input('psychiatric_conditions','No');
        $add->cardio_vascular_problems = $request->input('cardio_vascular_problems','No');
        $add->hypertension = $request->input('hypertension','No');
        $add->epilepsy = $request->input('epilepsy','No');
        $add->diabetes = $request->input('diabetes','No');
        $add->leprosy = $request->input('leprosy','No');
        $add->asthma = $request->input('asthma','No');
        $add->other = $request->input('other');
        $add->bank = $request->input('bank');
        $add->branch = $request->input('branch');
        $add->branch_code = $request->input('branch_code');
        $add->account_number = $request->input('account_number');
        $add->doc_address = $request->input('doc_address');
        $add->ecocash = $request->input('ecocash');
        $add->telecash = $request->input('telecash');
        $add->netcash = $request->input('netcash');

        $add->user_id = Auth::user()->id;
        $add->branch_id = Auth::user()->branch->id;
        $add->plan_id = $plans->id;
        if($add->save()){
            return redirect('/clients')->with('success','Succefully Updated.');
        }
            return redirect('/clients')->with('error');
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::find($id)->delete();
        return redirect('/clients')->with('success','Succefully Deleted');
    }
}

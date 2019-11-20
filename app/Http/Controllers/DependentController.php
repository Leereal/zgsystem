<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Dependent;
use App\Plan;
use Auth;
use Carbon\Carbon;
use App\Limit;
use App\WaitingPeriod;

class DependentController extends Controller
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
        $userbranch=Auth::user()->branch->id;

        $dependents= Dependent::with(['branch','plan','client'])->where([['status', '=', '1'],['branch_id', '=',$userbranch]])->get();
     
        return view('clients/dependents.index',compact('dependents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $client = Client::with('group')->find($id);            
        return view('clients.dependents.create',compact('client'));
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
                'name'=> 'required|min:2',
                'surname'=> 'required|min:2',
                'id_number'=> 'min:2|required|unique:dependents,id_number',
                'date_of_birth'=> 'date|min:2|required',               
                'gender'=> 'min:2|required'                                                                         
        ]); 

        //Generate Medical Aid Number

         $dependent = Dependent::where('client_id',$request->input('id'))->get()->last();//Last Dependent added
         if($dependent){
             $lastdependent=$dependent->medical_aid_number;
             $last2 = substr($lastdependent, -2);
             $last2plus1= sprintf("%02d", ++$last2);//Prepend with zero if not 2 digits 
             $medical_aid_number = substr_replace($lastdependent,$last2plus1, -2);
         }
         else{
            //Take principal medical aid number
            $pnam=$request->input('principal_medical_aid_number');
            //Take last 2 digits and increment          
            
            $last2 = substr($pnam, -2);//Take last 2 numbers from Principal MAN
            
            $last2plus1= sprintf("%02d", ++$last2);//Prepend with zero if not 2 digits            

            $medical_aid_number = substr_replace($pnam,$last2plus1, -2);//Create medical aid for first dependent
            
         }
        $plan = Plan::find($request->input('plan_id'));        
        $total_premium='';
        $add = new Dependent;
        $add->name = $request->input('name');
        $add->surname = $request->input('surname');
        $add->id_number = $request->input('id_number');
        $add->date_joined = Carbon::now();       
        $add->medical_aid_number = $medical_aid_number;        
        $add->gender = $request->input('gender');        
        $add->date_of_birth = $request->input('date_of_birth');

        //If corporate use corporate_premium
        if($request->input('group')){
            $add->group_id = $request->input('group');
            if(now()->diffInYears($request->input('date_of_birth'))<18){                
                $add->premium = $plan->corporate_dependent_premium;
                $total_premium = $plan->corporate_dependent_premium;
            }
            else{
                $add->premium = $plan->corporate_premium;
                $total_premium = $plan->corporate_premium;
            }
                      
        }
        else{
            if(now()->diffInYears($request->input('date_of_birth'))<18){
                $add->premium = $plan->dependent_premium;
                $total_premium = $plan->dependent_premium;
            }
            else{
                $add->premium = $plan->premium;
                $total_premium = $plan->premium;
            }                        
        } 

        $add->user_id = Auth::user()->id;
        $add->branch_id = Auth::user()->branch->id;
        $add->plan_id =$request->input('plan_id');
        $add->client_id =$request->input('id');

        if($add->save()){
            //Adding to Total premium to be paid by Principal Member
            $add->client()->increment('total_premium',$total_premium);

            //Creating Limits for Dependents            
            $addLimit = new Limit;
            $addLimit->global_limit = $plan->global_limit;
            $addLimit->plan_id = $plan->id;            
            $addLimit->hospitalization = $plan->hospitalization;
            $addLimit->ward_admission = $plan->ward_admission;            
            $addLimit->drugs = $plan->drugs;
            $addLimit->dental = $plan->dental;            
            $addLimit->optical = $plan->optical;
            $addLimit->oncology = $plan->oncology;
            $addLimit->dialysis = $plan->dialysis;          
            $addLimit->pathology = $plan->pathology;
            $addLimit->radiology = $plan->radiology;
            $addLimit->maternity = $plan->maternity;
            $addLimit->family_planning = $plan->family_planning;
            $addLimit->prosthesis = $plan->prosthesis;
            $addLimit->physiotherapy = $plan->physiotherapy;
            $addLimit->glucometer = $plan->glucometer;
            $addLimit->funeral_grant = $plan->funeral_grant;
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

            return redirect('/clients/dependents/view/'.$request->input('id'))->with('success','Succefully Saved. Dependent Medical Aid Number is '.$medical_aid_number);
        }
            return redirect('/clients/dependents/view/'.$request->input('id'))->with('error');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dependent = Dependent::with('plan')->find($id);    
        $claims = $dependent->claims()->with('serviceprovider')->get();
        $limit = $dependent->limit()->first();
        $plan = $dependent->plan()->first();         
        
        return view('dependents.profile',compact('dependent','claims','limit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dependent = Dependent::with(['plan','branch'])->find($id);
        $client = Client::with('group')->find($dependent->client_id);         
        return view('clients/dependents.edit',compact('dependent','client'));
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
                'name'=> 'required|min:2',
                'surname'=> 'required|min:2',
                'id_number'=> 'min:2|required',              
                'date_of_birth'=> 'date|min:2|required',                
                'gender'=> 'min:2|required'                                                                            
        ]);         

        $plan = Plan::find($request->input('plan_id'));        

        $add = Dependent::find($id);
        $add->name = $request->input('name');
        $add->surname = $request->input('surname');
        $add->id_number = $request->input('id_number');              
        $add->gender = $request->input('gender');        
        $add->date_of_birth = $request->input('date_of_birth');            
        $add->user_id = Auth::user()->id;                 

        if($add->save()){            
            return redirect('/clients/dependents')->with('success','Succefully Updated.');
        }
            return redirect('/clients/dependents')->with('error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Dependent::find($id)->delete();
        return redirect('/clients')->with('success','Succefully Deleted');
    }

    public function view($id)
    {
        $userbranch=Auth::user()->branch->id;

        $dependents= Dependent::with(['branch','plan','client'])->where([['status', '=', '1'],['client_id', '=',$id]])->get();
        //dd($dependents->toArray());
     
        return view('clients/dependents.view',compact('dependents'));
    }

    public function profile($id)
    {
       $dependent = Dependent::with('plan')->find($id);    
        //$claims = $dependent->claims()->with('serviceprovider')->get();
        $limit = $dependent->limit()->first();
        $plan = $dependent->plan()->first();         
        
        return view('/clients/dependents.profile',compact('dependent','plan','limit'));
    }
}

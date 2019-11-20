<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;

class PlanController extends Controller
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
        $plans = Plan::where('status',1)->get();
        return view('plans.index',compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plans.create');
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
                'premium'=> 'required',               
                'pre'=> 'required|unique:plans,pre',
                'last_number'=> 'required',
        ]);

        $add = new Plan;
        $add->name = $request->input('name');
        $add->premium = $request->input('premium');
        $add->dependent_premium = $request->input('dependent_premium');
        $add->corporate_premium = $request->input('corporate_premium');
        $add->corporate_dependent_premium = $request->input('corporate_dependent_premium');
        $add->pre = $request->input('pre');
        $add->last_number = $request->input('last_number');
        $add->global_limit = $request->input('global_limit');
        $add->hospitalization = $request->input('hospitalization');
        $add->ward_admission = $request->input('ward_admission');
        //$add->gp_consultations = $request->input('gp_consultations');// From Global Limit
        $add->drugs = $request->input('drugs');
        $add->dental = $request->input('dental');
        //$add->specialists_consultations = $request->input('specialists_consultations');
        $add->optical = $request->input('optical');
        $add->oncology = $request->input('oncology');
        $add->dialysis = $request->input('dialysis');
        //$add->ambulances = $request->input('ambulances');
        $add->pathology = $request->input('pathology');
        $add->radiology = $request->input('radiology');
        $add->maternity = $request->input('maternity');
        $add->family_planning = $request->input('family_planning');
        $add->prosthesis = $request->input('prosthesis');
        $add->physiotherapy = $request->input('physiotherapy');
        $add->glucometer = $request->input('glucometer');
        $add->funeral_grant = $request->input('funeral_grant');
        $add->save();

        return redirect('/plans')->with('success','Succefully Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = Plan::find($id);
        return view('plans.show')->with('plan',$plan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plan = Plan::find($id);
        return view('plans.edit')->with('plan',$plan);
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
                'name'=> 'required|min:2'                                
        ]);

        $add = Plan::find($id);
        $add->name = $request->input('name');
        $add->premium = $request->input('premium');
        $add->dependent_premium = $request->input('dependent_premium');
        $add->corporate_premium = $request->input('corporate_premium');
        $add->corporate_dependent_premium = $request->input('corporate_dependent_premium');
        $add->global_limit = $request->input('global_limit');
        $add->hospitalization = $request->input('hospitalization');
        $add->ward_admission = $request->input('ward_admission');
        //$add->gp_consultations = $request->input('gp_consultations');
        $add->drugs = $request->input('drugs');
        $add->dental = $request->input('dental');
        //$add->specialists_consultations = $request->input('specialists_consultations');
        $add->optical = $request->input('optical');
        $add->oncology = $request->input('oncology');
        $add->dialysis = $request->input('dialysis');
        //$add->ambulances = $request->input('ambulances');
        $add->pathology = $request->input('pathology');
        $add->radiology = $request->input('radiology');
        $add->maternity = $request->input('maternity');
        $add->family_planning = $request->input('family_planning');
        $add->prosthesis = $request->input('prosthesis');
        $add->physiotherapy = $request->input('physiotherapy');
        $add->glucometer = $request->input('glucometer');
        $add->funeral_grant = $request->input('funeral_grant');
        $add->save();

        return redirect('/plans')->with('success','Succefully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Plan::find($id)->delete();
        return redirect('/plans')->with('success','Succefully Deleted');
    }
}

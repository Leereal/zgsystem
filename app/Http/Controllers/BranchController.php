<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
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
        $branches = Branch::where('status',1)->get();
        return view('branches.index',compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('branches.create');
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
                'email'=>'email|nullable'                
        ]);

        $add = new Branch;
        $add->branch_name = $request->input('name');
        $add->branch_email = $request->input('email');
        $add->branch_phone = $request->input('phone');
        $add->branch_address = $request->input('address');
        $add->save();

        return redirect('/branches')->with('success','Succefully Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $branch = Branch::find($id);
        return view('branches.show')->with('branch',$branch);
    }

    /** 
     * Show the form for editing the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch = Branch::find($id);
        return view('branches.edit')->with('branch',$branch);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
                'name'=> 'required|min:2',
                'email'=>'email',                
        ]);

        $add = Branch::find($id);
        $add->branch_name = $request->input('name');
        $add->branch_email = $request->input('email');
        $add->branch_phone = $request->input('phone');
        $add->branch_address = $request->input('address');
        $add->save();

        return redirect('/branches')->with('success','Succefully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Branch::find($id)->delete();
        return redirect('/banks')->with('success','Succefully Deleted');
    }
}

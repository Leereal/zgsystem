<?php

namespace App\Http\Controllers;

use App\MOP;
use Illuminate\Http\Request;

class MOPController extends Controller
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
        $mops = MOP::where('status',1)->get();
        return view('mops.index',compact('mops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=request()->validate([
            'name'=> 'required|min:2'                                                        
        ]);
        return MOP::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MOP  $mOP
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MOP  $mOP
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bank = Bank::find($id);
        return $bank;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MOP  $mOP
     * @return \Illuminate\Http\Response
     */
    public function update(MOP $mop)
    {        
        $data=request()->validate([
            'name'=>'required|min:2'            
        ]);        
        $mop->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MOP  $mOP
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MOP::find($id)->delete();
        return redirect('/mops')->with('success','Succefully Deleted');
    }
}

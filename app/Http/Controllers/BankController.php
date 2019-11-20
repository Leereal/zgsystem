<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank;

class BankController extends Controller
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
        $banks = Bank::where('status',1)->get();
        return view('banks.index',compact('banks'));
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
            'name'=> 'required|min:2',
            'account_number'=> 'min:2|nullable',
            'branch_code'=> 'nullable|min:2'                                            
        ]);
        return Bank::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Bank $bank)
    {
        
        $data=request()->validate([
            'name'=> 'required|min:2',
            'account_number'=> 'nullable|min:2', 
            'branch_code'=> 'nullable|min:2'                                             
        ]);
        
      $bank->update($data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        Bank::find($id)->delete();
        return redirect('/banks')->with('success','Succefully Deleted');
    }
}

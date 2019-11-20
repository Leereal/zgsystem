<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Role;
use App\Branch;


class UserController extends Controller
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
        $users = User::with(['roles', 'branch'])->get();
        $roles = Role::all();
        $branches = Branch::all();             
        return view('users.index',compact('users','roles','branches'));
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
        //
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
        $user = User::find($id);
        $branches = Branch::all();
        $roles = Role::all();

       return view('users.edit',compact('user','roles','branches'));
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
            'branch'=> 'required|integer',
            'role'=> 'required|integer'                                            
        ]);
        User::where('id',$id)->update(['branch_id'=>$request->input('branch'),'status'=>1]);
        $user = User::find($id);
        $role = Role::find($request->input('role'));
        $user->roles()->attach($role);
        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect('/users')->with('success','Succefully Deleted');
    }

    public function delete($id)
    {
        User::destroy($id);
        return redirect('/users')->with('success','Succefully Deleted');
    }  

    public function changeStatus($id)
    {
        $user = User::findOrFail($id);
        if($user->status==0){            
           User::where('id',$id)->update(['status'=>1]);
        }
        else{            
            User::where('id',$id)->update(['status'=>0]);
        }    
        //$user = User::where('id',$id)->update(['status'=>0]);              
        return redirect('/users');
    }

    public function approveUser(Request $request, $id)
    {
        $this->validate($request, [
            'bank'=> 'required|integer',
            'role'=> 'required|integer'                                            
        ]);
        User::find($id)->$request->input('branch')->save();
        return back();
    }
}

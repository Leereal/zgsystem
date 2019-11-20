<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceProvider;
use App\Category;

class ServiceProviderController extends Controller
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
        $service_providers = ServiceProvider::where('status',1)->get();
        return view('service_providers.index',compact('service_providers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status',1)->orderBy('name')->get();
        return view('service_providers.create',compact('categories'));
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
                'name'=> 'required|min:2|unique:service_providers,name',
                'email'=>'email|nullable',
                'category'=>'required',
                'ahfoz_number'=>'required|unique:service_providers,ahfoz_number'                                 
        ]);

        $add = new ServiceProvider;
        $add->name = $request->input('name');
        $add->coverage = $request->input('coverage');
        $add->coverage = $request->input('coverage');
        $add->ahfoz_number = $request->input('ahfoz_number');
        $add->contact_person = $request->input('contact_person');
        $add->address = $request->input('address');
        $add->phone_number = $request->input('phone_number');
        $add->cell_number = $request->input('cell_number');
        $add->bank = $request->input('bank');
        $add->branch_code = $request->input('branch_code');
        $add->account_number = $request->input('account_number');
        $add->email = $request->input('email');        
        $add->save();
        $add->categories()->sync($request->input('category'));

        return redirect('/service_providers')->with('success','Succefully Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service_provider = ServiceProvider::find($id);
        return view('service_providers.show')->with('service_provider',$service_provider);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service_provider = ServiceProvider::find($id);
        $categories = Category::where('status',1)->orderBy('name')->get();  
        return view('service_providers.edit',compact('service_provider','categories'));
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
                'category'=>'required',
                'email'=>'email',
                'ahfoz_number'=>'required|min:2'                                  
        ]);

        $add = ServiceProvider::find($id);
        $add->name = $request->input('name');
        $add->coverage = $request->input('coverage');
        $add->ahfoz_number = $request->input('ahfoz_number');        
        $add->contact_person = $request->input('contact_person');
        $add->address = $request->input('address');
        $add->phone_number = $request->input('phone_number');
        $add->cell_number = $request->input('cell_number');
        $add->bank = $request->input('bank');
        $add->branch_code = $request->input('branch_code');
        $add->account_number = $request->input('account_number');
        $add->email = $request->input('email');        
        $add->save();
        $add->categories()->sync($request->input('category'));

        return redirect('/service_providers')->with('success','Succefully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {       
        ServiceProvider::find($id)->delete();
        return redirect('/service_providers')->with('success','Succefully Deleted');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tariff;
use App\Category;

class TariffController extends Controller
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
        $tariffs = Tariff::with('categories')->where('status',1)->get();
        return view('tariffs.index',compact('tariffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status',1)->orderBy('name')->get();
        return view('tariffs.create',compact('categories'));
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
                'code'=> 'required|min:2',
                'category'=>'required',
                'fee'=>'required|regex:/^\d+(\.\d{1,2})?$/',                
        ]);

        $add = new Tariff;
        $add->code = $request->input('code');
        $add->fee = $request->input('fee');
        $add->save();
        $add->categories()->attach($request->input('category'));

        return redirect('/tariffs')->with('success','Succefully Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tariff = Tariff::find($id);
        return view('tariffs.show')->with('tariff',$tariff);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tariff = Tariff::find($id);
        $categories = Category::where('status',1)->orderBy('name')->get();        
        return view('tariffs.edit',compact('categories','tariff'));
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
                'code'=> 'required|min:2',                
                'category'=>'required',
                'fee'=>'required|regex:/^\d+(\.\d{1,2})?$/'                
        ]);

        $add = Tariff::find($id);
        $add->code = $request->input('code');
        $add->fee = $request->input('fee');
        $add->save();
        $add->categories()->sync($request->input('category'));

        return redirect('/tariffs')->with('success','Succefully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tariff::find($id)->delete();
        return redirect('/tariffs')->with('success','Succefully Deleted');
    }
}

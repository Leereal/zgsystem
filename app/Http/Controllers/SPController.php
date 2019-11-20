<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class SPController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	
        $clients = Client::with(['plan','branch'])->active()->get();
        return view('serviceprovider.index',compact('clients'));
    }
}

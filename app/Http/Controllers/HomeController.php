<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $drugs = \App\Drug::orderBy('name','asc')->take(20)->get();
        return view('home',compact('drugs'));
    }
}

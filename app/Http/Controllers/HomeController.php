<?php

namespace App\Http\Controllers;
use App\Drug;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $drugs = Drug::orderBy('name','asc')->take(20)->get();
        return view('home',compact('drugs'));
    }
}

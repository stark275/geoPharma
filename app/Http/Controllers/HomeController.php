<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
         $shops = \App\Shop::find(1);
         //dd(json_encode($shops));
        return view('home');
    }
}

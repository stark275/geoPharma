<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Shop,User};

class ShopController extends Controller
{
    public function index(Shop $shop)
    {
        
       $shops = $shop::where('id','<','7')->get();

        return view('shop.index',compact('shops'));
    }

    public function map()
    {
        //dd(route('shop.map'));
        return view('shop.map');
    }


}

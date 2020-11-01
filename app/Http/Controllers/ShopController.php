<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Shop,User};

class ShopController extends Controller
{
    public function show($id)
    {
        $shop = \App\Shop::find($id);
        dd($shop);
        return view('shop.index',compact('shops'));
    }



}

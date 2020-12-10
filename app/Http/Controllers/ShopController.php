<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Shop,User};

class ShopController extends Controller
{
    public function show($id)
    {
        $shop = \App\Shop::find($id);
        $drugs = $shop->drugs()->paginate(12);

        return view('shop.show',compact('shop','drugs'));
    }



}

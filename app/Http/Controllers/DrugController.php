<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DrugController extends Controller
{
    public function index()
    {
        return view('drug.index');
    }


    public function show($id)
    {
        $drug = \App\Drug::find($id);
        $shops = $drug->shops->sortBy(function($shop,$key){
            return $shop->pivot->price;
        })->values()->all();

        //for ($i=0; $i < 48 ; $i++) 
            //dump($shops[$i]->pivot->price);     
         
        return view(
            'drug.show',
            compact('drug','shops')
        );     
    }
}

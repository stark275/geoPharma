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
        $shops = [];
        
        if ($drug) {
             $shops = $drug->shops->sortBy(function($shop,$key){
                return $shop->pivot->price;
            })->values()->all();
        }
       

       // dd($shops);
             
        return view(
            'drug.show',
            compact('drug','shops')
        );     
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Planning;
use App\DrugPlanning;


class PlanningController extends Controller
{
    public function store(Request $request)
    {
       $plan =  Planning::create([
            'name' => $request->name,
            'description' => 'Description',
            'user_id' => 1
        ]);

        return response()->json(Planning::find($plan->id));
    }

    public function addFeature(Request $request)
    {
        return DrugPlanning::create([
            'drug_shop_id' => $request->id,
            'planning_id' => 17 // dynamically
        ]);

       
    }

    public function test()
    {
        $d = DB::table('drugs')
            ->join('drug_shop', 'drugs.id', '=', 'drug_shop.drug_id')
            ->select('drugs.*')
            ->where('drug_shop.id','=',2)
            ->get();

        dd($d);
    }
}

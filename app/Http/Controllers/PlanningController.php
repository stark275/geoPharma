<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Planning;
use App\DrugPlanning;


class PlanningController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request)
    {
       
        return view('planning.show');
    }

    public function store(Request $request)
    {
       $plan =  Planning::create([
            'name' => $request->name,
            'description' => 'Description',
            'user_id' => auth()->user()->id
        ]);

        return response()->json(Planning::find($plan->id));
    }

    public function addFeature(Request $request)
    {
        $logged = true;
        if ($logged === true) {
         
            $row = DrugPlanning::where('drug_shop_id', '=', $request->id)
                               ->where('planning_id', '=', $request->planningId)
                               ->first();

            if ($row === null) {
                $row = DrugPlanning::create([
                    'drug_shop_id' => $request->id,
                    'planning_id' => $request->planningId
                ]);
            }else{
                $row->update([
                    'quatity' =>( $row->quatity + 1 )
                ]);
            }

            return $row;
        }  
        return true;
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

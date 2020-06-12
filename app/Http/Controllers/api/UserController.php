<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\planning;
use App\Drug;
use App\Shop;



class UserController extends Controller
{
    public function planning($id)
    {
        $plan = Planning::where('user_id','=',$id)
                ->orderBy('created_at','desc')
                ->first();

        $drug = [];
        $drugs = $plan->drugShops->map(function ($pivot){
            $d = \DB::table('drugs')
            ->join('drug_shop', 'drugs.id', '=', 'drug_shop.drug_id')
            ->select('drugs.*')
            ->where('drug_shop.id','=',2)
            ->get();

            $s = \DB::table('shops')
                    ->join('drug_shop', 'shops.id', '=', 'drug_shop.shop_id')
                    ->select('shops.*')
                    ->where('drug_shop.id','=',2)
                    ->get();
            return [
                'drug' => $d,
                'shop' => $s,
                //'price' => $pivot->price
            ];
        });

        return response()->json($drugs); 
    }

   
}

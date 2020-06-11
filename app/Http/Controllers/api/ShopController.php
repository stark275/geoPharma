<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Shop as ShopResource; 

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $shops = \App\Shop::all();
        $geoJSONdata = $shops->map(function ($shop){
            return [
                'type'       => 'Feature',
                'properties' => new ShopResource($shop),
                'geometry'   => [
                    'type'        => 'Point',
                    'coordinates' => [
                        $shop->longitude,
                        $shop->latitude,
                    ],
                ],
            ];
        });

        return response()->json([
            'type'     => 'FeatureCollection',
            'features' => $geoJSONdata,
        ]);
    }

    public function specificaldrug($id)
    {
        $drug = \App\Drug::find($id);
        $geoJSONdata = [];

        if ($drug) {
            $geoJSONdata = $drug->shops->map(function($shop){
                return [
                    'type'       => 'Feature',
                    'properties' => new ShopResource($shop),
                    'geometry'   => [
                        'type'        => 'Point',
                        'coordinates' => [
                            $shop->longitude,
                            $shop->latitude,
                        ],
                    ],
                ];
            });
        }
        
        return response()->json([
            'type'     => 'FeatureCollection',
            'features' => $geoJSONdata,
        ]);
    }
}

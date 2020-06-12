<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Planning;

class Newplanning extends Component
{

    public $planning = '';

    public $hasPlanning = false;

    public $features = [];

    public function mount()
    {
        $this->fill([
            'planning' => $this->getPlanningName(),
            'hasPlanning' => $this->hasPlanning(),
            'features' => $this->getfeatures()
        ]);
    }

    public function submit()
    {
        $this->validate([
            'planning' => 'required|min:6'
        ]);

        // Execution doesn't reach here if validation fails.

        Planning::create([
            'name' => $this->planning,
            'description' => 'desc',
            'user_id' => 1
        ]);

        $this->reset();
    }

    private function getPlanningName()
    {
        $plan = Planning::where('user_id','=',1)
                ->orderBy('created_at','desc')
                ->first();

        return ($plan->name) ?  $plan->name : '';
    }

    private function hasPlanning()
    {
        $plan = Planning::where('user_id','=',1)
                ->where('current','=','1')
                ->orderBy('created_at','desc')
                ->first();
        return (isset($plan->current) && $plan->current == '1') ?  true : false;
    }

    public function getfeatures()
    {
        $plan = Planning::where('user_id','=',1)
                ->orderBy('created_at','desc')
                ->first();

        $drugs = [];
        $drugs = $plan->drugShops->map(function ($pivot){
            $d = \DB::table('drugs')
            ->join('drug_shop', 'drugs.id', '=', 'drug_shop.drug_id')
            ->select('drugs.*')
            ->where('drug_shop.id','=',$pivot->drug_shop_id)
            ->first();

            $s = \DB::table('shops')
                    ->join('drug_shop', 'shops.id', '=', 'drug_shop.shop_id')
                    ->select('shops.*')
                    ->where('drug_shop.id','=',$pivot->drug_shop_id)
                    ->first();

            $p = \DB::table('drug_shop')
                    ->select('price')
                    ->where('id','=',$pivot->drug_shop_id)
                    ->first();
            return [
                'drug' => $d,
                'shop' => $s,
                'price' => $p
            ];
        });
        //dd($drugs);
       return collect($drugs)->all();
    }

    public function render()
    {
        return view('livewire.newplanning');
    }
}

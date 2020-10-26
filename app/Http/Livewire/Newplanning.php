<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Planning;

class Newplanning extends Component
{

    public $planningId ;

    public $planningName = '';

    public $planningPrice = 0 ;

    public $hasPlanning = false;

    public $features = [];

    protected $listeners = ['featureAdded' => 'updateFeatures'];

    public function mount()
    {
        // dd($this->getCurrentPlanning());

        $planning = $this->getPlanningByRoute('planning.show');

        $this->fill([
            'planningId' => $planning->id,
            'planningName' => $this->getCurrentPlanning()->name,
            'hasPlanning' => $this->hasPlanning(),
            'features' => $this->getfeatures()
        ]);

    }
 
    public function submit()
    {
        $this->validate([
            'planningName' => 'required|min:6'
        ]);

        // Execution doesn't reach here if validation fails.

        Planning::create([
            'name' => $this->planningName,
            'description' => 'desc',
            'user_id' => 1
        ]);

        $this->reset();
    }

    public function updateFeatures()
    {
        $this->features = $this->getfeatures();
        \Flashy::message('Welcome aboard!', 'http://your-awesome-link.com');
    }

    private function getPlanning()
    {
        $plan = Planning::where('user_id','=',1)
                ->where('id',Request()->id)
                ->first();

        return $plan;
    }

    private function getCurrentPlanning()
    {
        $plan = Planning::where('user_id','=',1)
                ->where('current','1')
                ->first();

        return $plan;
    }

    private function hasPlanning()
    {
        $plan = Planning::where('user_id','=',1)
                ->where('current','=','1')
                ->orderBy('created_at','desc')
                ->first();
        return (isset($plan->current) && $plan->current == '1') ?  true : false;
    }

    private function getPlanningByRoute($routeName)
    {
        $route = \Route::current()->getName();
        switch ($route) {
            case $routeName:
                $plan = $this->getPlanning();
                break;
            default:
                $plan = $this->getCurrentPlanning();
                break;
        }

        return $plan;
    }

    public function getfeatures()
    {


        $plan = $this->getPlanningByRoute('planning.show');
       //todo: Si le planning nexiste pas

        $drugs = [];
        $drugs = $plan->drugPlanning->map(function ($pivot){
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

            $this->planningPrice += ($p->price * $pivot->quatity) ;
            
            return [
                'drug' => $d,
                'shop' => $s,
                'price' => $p,
                'qty' => $pivot->quatity
            ];

          //  dd($this->planningPrice, $p->price, $pivot->quatity);

        });

        //dd($this->planningPrice);

       return collect($drugs)->all();
    }

    public function render()
    {
        return view('livewire.newplanning');
    }
}

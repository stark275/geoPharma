<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Drug;

class Search extends Component
{
    public $drugs = [];

    public $search;

    public function updatedSearch()
    {
        $this->drugs = $this->getDrugsByName($this->search);
    }

    public function getDrugsByName($needle)
    {
        return collect(
           Drug::where('name','like','%'.$needle.'%')
                    ->take(10)
                    ->get()
        )->all();
    }

    public function render()
    {
        return view('livewire.search');
    }
}

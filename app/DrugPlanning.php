<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrugPlanning extends Model
{
    protected $table = 'drug_planning';

    public function plannings()
    {
       return $this->belongsTo('App\Planning'); 
    }
}

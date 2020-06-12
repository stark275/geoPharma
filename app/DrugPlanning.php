<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrugPlanning extends Model
{
    protected $table = 'drug_planning';

    protected $fillable = ['drug_shop_id','planning_id'];

    public function plannings()
    {
       return $this->belongsTo('App\Planning'); 
    }
}

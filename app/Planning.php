<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    protected $fillable = ['name','description','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function drugPlanning()
    {
        return $this->hasMany('App\DrugPlanning');
    }
}

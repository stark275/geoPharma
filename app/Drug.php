<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{

     /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    public $appends = [
      'price' 
    ];

     /**
     * Get outlet coordinate attribute.
     *
     * @return string|null
     */
    public function getPriceAttribute()
    {
        return 44;
    }
   public function shops()
   {
       return $this->belongsToMany('App\Shop')
                   ->withPivot('price');
   }
}

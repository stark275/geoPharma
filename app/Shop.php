<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
     /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    public $appends = [
        'coordinate', 'map_popup_content', 'drug_info'
    ];

    /**
     * Get outlet coordinate attribute.
     *
     * @return string|null
     */
    public function getCoordinateAttribute()
    {
        if ($this->latitude && $this->longitude) {
            return $this->latitude.', '.$this->longitude;
        }
    }

    /**
     * Get outlet map_popup_content attribute.
     *
     * @return string
     */
    public function getMapPopupContentAttribute()
    {
        $mapPopupContent = '';
        $mapPopupContent .= '<div ><strong>'.ucfirst($this->name).'</strong></div>';
        $mapPopupContent .= '<div ><strong></strong>'.$this->cover.'</div>';

        return $mapPopupContent;
    }

     /**
     * Get outlet map_popup_content attribute.
     *
     * @return string
     */
    public function getDrugInfoAttribute()
    {   
        $price = (isset($this->pivot->price)) ? $this->pivot->price : null ;
        $mapPopupContent = '';
        $mapPopupContent .= '<div ><strong>'.ucfirst($this->name).'</strong></div>';
        $mapPopupContent .= '<div ><strong></strong>'.$price.' CDF</div>';
        $mapPopupContent .= '';

        return $mapPopupContent;
    }

    
    public function user()
    {
       return $this->belongsTo('App\User');
    }

    public function drugs()
    {
        return $this->belongsToMany('App\Drug')
                    ->withPivot('price');
    }
}

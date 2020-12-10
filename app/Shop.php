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
        $mapPopupContent .= '<div class="card" >';
        $mapPopupContent .= '<div class="card-body">';
        $mapPopupContent .= '<img class="card-img" src="img/p.jpg" >';
        $mapPopupContent .= '<div ><strong>'.ucfirst($this->name).'</strong></div>';
      
        $mapPopupContent .= '<a href="'.route('shop.show',$this->id).'" class="btn btn-primary"> Visiter </a>';
        $mapPopupContent .= '</div>';
        $mapPopupContent .= '</div>';


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
        $id = (isset($this->pivot->id)) ? $this->pivot->id : null ;

        $mapPopupContent = '';
        $mapPopupContent .= '<div ><strong>'.ucfirst($this->name).'</strong></div>';
        $mapPopupContent .= '<div ><strong></strong>'.$price.' CDF</div>';
        $mapPopupContent .= '<div id="addfeature" class="btn btn-primary" data-feature-id="'.$id.'"> Ajouter</div>';

        return $mapPopupContent;
    }

    
    public function user()
    {
       return $this->belongsTo('App\User');
    }

    public function drugs()
    {
        return $this->belongsToMany('App\Drug')
                    ->withPivot('id','price');
    }
}

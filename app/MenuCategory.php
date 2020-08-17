<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    protected $table = 'menu_catagories';


    public function parent()
    {   
        return $this->belongsTo(static::class , 'parent_category_id');
    }
}

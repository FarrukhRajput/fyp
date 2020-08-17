<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    public function getCategory()
    {   
        return $this->belongsTo(MenuCategory::class ,  'menu_category_id');
    }

    public function parentCategory()
    {
        
       return $this->belongsTo(MenuCategory::class ,  'id'); 
    }
}

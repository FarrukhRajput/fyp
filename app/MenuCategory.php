<?php

namespace restro;

use restro\Product;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    protected $table = 'menu_catagories';

    public function products()
    {
        return $this->hasMany(Product::class , 'menu_category_id');
    }


    public function parent()
    {   
        return $this->belongsTo(static::class , 'parent_category_id');
    }
}

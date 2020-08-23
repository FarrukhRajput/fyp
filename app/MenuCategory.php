<?php

namespace restro;

use restro\Product;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    protected $table = 'menu_catagories';
    protected $fillable = [ 'title' ];


    public function getMenuProducts()
    {
        return $this->hasMany(Product::class, 'menu_category_id');
    }

}

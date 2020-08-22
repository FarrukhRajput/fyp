<?php

namespace restro;

use Illuminate\Database\Eloquent\Model;

class ItemCatagory extends Model
{
    // protected $table = 'item_catagories' ;

    public function parent()
    {
        return $this->belongsTo(static::class,'parent_catagory_id');
    }

}

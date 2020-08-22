<?php

namespace restro;

use restro\ItemCatagory;

use Illuminate\Database\Eloquent\Model;

class RawItem extends Model
{
    protected $table = "rawitems";

    public function catagory(){
        return $this->belongsTo('restro\ItemCatagory');
    }

    public function vendor()
    {   
        return $this->belongsTo(Vendor::class);
    }

  
}

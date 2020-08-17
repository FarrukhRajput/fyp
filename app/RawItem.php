<?php

namespace App;

use App\ItemCatagory;

use Illuminate\Database\Eloquent\Model;

class RawItem extends Model
{
    protected $table = "rawitems";

    public function catagory(){
        return $this->belongsTo('App\ItemCatagory');
    }

    public function vendor()
    {   
        return $this->belongsTo(Vendor::class);
    }

  
}

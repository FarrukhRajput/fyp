<?php

namespace App;

use App\RawItem;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'f_name','l_name','cnic','phone','company_name'
    ];


    public function allProducts()
    {
        return $this->hasMany(RawItem::class, 'vendor_id');
    }

}

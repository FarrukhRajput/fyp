<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'f_name','l_name','cnic','phone','company_name'
    ];

}

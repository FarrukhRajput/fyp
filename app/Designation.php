<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $fillable = ['title' , 'group_id'];

    public function group(){
        return $this->belongsTo(StaffGroup::class);
    }

}

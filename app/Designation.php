<?php

namespace restro;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $fillable = ['title' , 'staff_group_id'];

    public function group(){
        return $this->belongsTo(StaffGroup::class, 'staff_group_id');
    }

}

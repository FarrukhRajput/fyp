<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // protected $fillable = ['gender'];

    public function group(){
        return $this->belongsTo(StaffGroup::class, 'staff_id');
    }

    public function designation(){
        return $this->belongsTo(Designation::class, 'designation_id');
    }

}

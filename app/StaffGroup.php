<?php

namespace restro;

use Illuminate\Database\Eloquent\Model;

class StaffGroup extends Model
{
    protected $fillable = [ 'title' ] ;

    public function designations(){
        return $this->hasMany(Designation::class, 'staff_group_id' );
    }
   
}

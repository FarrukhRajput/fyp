<?php

namespace restro\Http\Controllers;

use restro\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    
    public function all()
    {
        $tables = Table::all();
        return $tables;
    }


    // public function store()
    // {

    //     for($i = 1 ; $i <= 40 ; $i++){
    //         $val = "Table ".$i;

    //         Table::create([
    //             'title' => $val
    //         ]);
    //     }
    // }


}

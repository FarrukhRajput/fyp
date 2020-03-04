<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemCatagory extends Controller
{   
   
    

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('store.item_catagory',['title' => 'Item Catagory' ]);
    }

    public function createCatagory(){
        return view('store.create_item_catagory', ['title' => 'Create Catagory' ]);
    }
}


<?php

namespace restro\Http\Controllers;

use Illuminate\Http\Request;
use restro\Employee;

class SystemUserController extends Controller
{
    
    public function index()
    {   
        $users = Employee::all();
        dd($users);
    }
}

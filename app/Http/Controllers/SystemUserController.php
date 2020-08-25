<?php

namespace restro\Http\Controllers;

use Illuminate\Http\Request;
use restro\Employee;
use restro\UserRole;
use restro\User;

use App\Http\Controllers\Hash;


class SystemUserController extends Controller
{
    
    public function index()
    {   
        $users = Employee::all()->where('status','==' ,true);
        $roles  = UserRole::all();

        // dd($roles);
        return view('system_user.system_user')->withUsers($users)->withRoles($roles);
    }



    public function store(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'password_confirmation'  => 'required',
            
        ]);

        if($request->id){
            dd("update");
        }
        else{

            $newUser = new User(); 
            $user = Employee::find($request->employee_id);
            $newUser->email = $user->f_name.''.$user->l_name;
            $newUser->email = $user->email;
            $newUser->password = Hash::make($request->password);
            $newUser->allow_access = $request->allow_access;


            dd($newUser);

        }

        




        
    }

}

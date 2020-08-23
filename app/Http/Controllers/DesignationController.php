<?php

namespace restro\Http\Controllers;

use Illuminate\Http\Request;

use \restro\StaffGroup;
use \restro\Designation;

class DesignationController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

   
    public function index()
    {   
        $staffGroup = StaffGroup::all();
        $designations = Designation::with(['group'])->get();
        
        return view('employee.designation', [ 
            'designations' => $designations,
            'group' => $staffGroup 
        ]);
    }


    
    public function store(Request $request)
    {

        request()->validate([
            'title' => 'required',
            'staff_group_id' => 'required'
        ]);

        if(@$request->id){

            $this->update($request);
            return back()->with('message' , 'Desgination Updated Succesfully');

        }else{

            Designation::create([
                'title' => $request->title,
                'staff_group_id' => $request->staff_group_id
            ]);

            return back()->with('message' , 'Desgination Created Succesfully');

        }
    }

    
    public function show($id)
    {
        $staffGroup = StaffGroup::all();
        $designations = Designation::with(['group'])->get();
        $designation = Designation::find($id);

        return view('employee.designation', [           
            'designation' => $designation,
            'designations' => $designations,
            'group' => $staffGroup 
        ]);
    }

    public function edit($id)
    {
        //
    }

   
    public function update($request)
    {   
        $designation = Designation::find($request->id);
        $designation->update($request->all());
    }

   
    public function destroy($id)
    {
        $designation = Designation::find($id);
        $designation->delete();
        return back()->with('message' , 'Desgination Deleted Succesfully');
    }
}

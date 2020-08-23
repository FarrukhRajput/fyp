<?php

namespace restro\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use \restro\Designation;
use \restro\StaffGroup;

class StaffGroupController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }



    public function index(){
        $allGroups = StaffGroup::all();
        
        return view('employee.staff' , [
            'groups' =>  $allGroups  
        ]); 
    }



    public function store(Request $request){

        $request->validate([
            'title' => 'required'
        ]);


        // Update's the staff group  
        if($request->id){
            $this->update($request);
            return back()->with('success' , 'Staff Group Updated Successfully' );
        }
        
        // store's the staff group  
        else{
            $staffGroup = StaffGroup::create([
                'title' =>  $request->title
            ]);    
           return back()->with('success' , 'Staff Group Created Successfully' );
        }
    }


    public function edit($id){
        $group = StaffGroup::find($id);
        $groups = StaffGroup::all();

        return view('employee.staff', [
            'group' => $group, 
            'groups' => $groups 
        ]);
    }



    public function update($request)
    {   

        $request->validate([
            'title' => 'required'
        ]);

        $group = StaffGroup::findorfail($request->id);
        $group->title = $request->title;
        $group->save();
    }



    public function destroy($id)
    {       
        $group = StaffGroup::find($id);
        $groups = StaffGroup::all();

        if( $group->designations->count() == 0){
            $group =  StaffGroup::find($id);
            $group->delete();
            return back()->with('success' , 'Staff Group Deleted Successfully');
        }else{
            return back()->with('id', $group->id)->with('alert', 'Staff Group contains some desginations, Please, delete all Designations related to "'.$group->title .'".');
        }
        
    }

   public function forceDelete($id)
    {

        $group = StaffGroup::find($id);

        foreach ($group->designations as $designation) {
            $designation->delete();
        }

        $group->delete();
        return redirect()->route('staff.index')->with('success' , 'Deleted all desgination related to group');
    }


    public function getDesignations($id)
    {
        $designations = Designation::where('staff_group_id', $id)->get();
        return response()->json($designations);
    }


}

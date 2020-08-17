<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use \App\Designation;
use \App\StaffGroup;

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

        if($request->id){
            $this->update($request);
            return back()->with('message' , 'Updated');
        }
        
        else{
            $staffGroup = StaffGroup::create([
                'title' =>  $request->title
            ]);    
           return back()->with('message' , 'Staff Group Created Successfully' );
        }
    }


    public function show($id){
        $group = StaffGroup::find($id);
        $groups = StaffGroup::all();

        return view('employee.staff', [
            'group' => $group, 
            'groups' => $groups 
        ]);
    }

    public function update($request)
    {   
        $group = StaffGroup::find($request->id);
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
            return redirect()->route('staff.index')->with('message' , 'Deleted');
        }else{
            return redirect()
            ->route('staff.show' , [
                'group' => $group,
                'groups' => $groups ])
            ->with('alert', 'Group Contains Some Desginations, Delete Related Designations First..');
        }
        
    }

   public function forceDelete($id)
    {
        $group = StaffGroup::find($id);

        foreach ($group->designations as $designation) {
            $designation->delete();
        }
        return redirect()->route('staff.index')->with('message' , 'Deleted all desgination related to group');
    }


    public function getDesignation($id)
    {
        $designations = Designation::where('group_id', $id)->get();
        

    
        return response()->json($designations);
    }


}

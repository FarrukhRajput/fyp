<?php

namespace restro\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use restro\StaffGroup;
use restro\Designation;
use restro\Employee;

class EmployeesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $employees = Employee::with(['group' , 'designation'])->get();

        return view('employee.all_employee', [
            'employees' => $employees
        ]);
    }

    public function create(){
        $groups = StaffGroup::with(['designations'])->get();
        return view('employee.employee', [
            'groups' => $groups
        ]);
    }

   public function store(Request $request){

        $request->validate([
            'f_name' => 'required',
            'l_name' => 'required',
            'father_name' => 'required',
            'dob' => 'required',
            'cnic' => 'required',
            'staff_id' => 'required',
            'salary' => 'required',
            'phone' => 'required',
            'designation_id' => 'required',
            'email' => 'required',
            'joining_date' => 'required',
            'gender' => 'required'
        ]);


        if(@$request->id){
            $this->update($request);
            return back()->with('message' , 'Employee Edited Succesfully');
        }

        else{  

            $imagePath  = "images/employees/";
            // renaming the uploaded file
            if($request->image){
                $imageName = time().'.'.$request->file('image')->getClientOriginalExtension();  
                $destinationPath = public_path('images/employees');
                request()->image->move($destinationPath, $imageName); 
                $imagePath = $imagePath.$imageName;
            }
            
            else{
                $imagePath =  'images/avatar.png';
            }
            
            $employee = new Employee();
            $employee->image =  $imagePath;
            $employee->f_name =  $request->f_name;
            $employee->l_name = $request->l_name;
            $employee->father_name = $request->father_name;
            $employee->cnic = $request->cnic;
            $employee->dob = $request->dob ;
            $employee->gender = $request->gender ;
            $employee->joining_date = $request->joining_date;
            $employee->staff_id = $request->staff_id ;
            $employee->designation_id = $request->designation_id ;
            $employee->salary =  $request->salary ;           
            $employee->email =  $request->email ;

            if($request->address){
                $employee->address =  $request->address ;
            }
            $employee->address =  '' ;

            if($request->city){
                $employee->city =  $request->city ;
            }
            $employee->city =  '' ;

            $employee->phone =  $request->phone ;

            if($request->phone_optional){
                $employee->phone_optional =  $request->phone_optional ;
            }
        
            $employee->remarks = $request->remarks; 

            if($request->status){
                $employee->status = true ;
            }
          
            $employee->save();

            return back()->with('success' , 'Employee Created Succesfully');
        }
   }


   public function edit($id){
        $employee = Employee::with(['group' ,'designation'])->get();
        $groups = StaffGroup::with(['designations'])->get();
        $employeeSelected = $employee->find($id) ;
    
        // dd($StaffGroup->relations()->exists());
       return  view('employee.employee' , [
            'groups' => $groups,
            'employee' => $employeeSelected
        ]);

   }

    public function update($request)
    {   

        $employee = Employee::find($request->id);
        $imagePath  = "images/employees/";

        if($request->image){
            $imageName = time().'.'.$request->file('image')->getClientOriginalExtension();  
            $destinationPath = public_path('images/employees');
            request()->image->move($destinationPath, $imageName); 
            $imagePath = $imagePath.$imageName;
            $employee->image =  $imagePath;
        }
       
        $employee->f_name =  $request->f_name;
        $employee->l_name = $request->l_name;
        $employee->father_name = $request->father_name;
        $employee->cnic = $request->cnic;
        $employee->dob = $request->dob ;
        $employee->gender = $request->gender ;
        $employee->joining_date = $request->joining_date;
        $employee->staff_id = $request->staff_id ;
        $employee->designation_id = $request->designation_id ;
        $employee->salary =  $request->salary ;           
        $employee->email =  $request->email ;
        $employee->phone =  $request->phone ;
        $employee->phone_optional =  $request->phone_optional ;
        if($request->address){
            $employee->address =  $request->address ;
        }
        $employee->address =  '' ;

        if($request->city){
            $employee->city =  $request->city ;
        }
        $employee->city =  '' ; 
       
        $employee->remarks = $request->remarks;


        if($request->status){
            $employee->status = true ;
        }else{
            $employee->status = false ;
        }
        
        $employee->save();
        return back()->with('success' , 'Employee updated Succesfully');
    }


    public function destroy($id)
    {
        $employee = employee::find($id);
        $employee->delete();
        return back()->with('success' , 'Employee Deleted Succesfully');
    }

}

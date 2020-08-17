<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Illuminate\Support\Facades\Storage;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Vendor;

class VendorsController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    
    public function index(){
        $vendors = Vendor::all();
        return view('vendor.vendors', [ 'vendors' => $vendors ]);
    }


    /** 
     * *
     *  New Vendor Page  
     * */  
    public function create(){
       
        return view('vendor.create_vendor');
    }



    public function edit($id){
        $title = "edit vendor"; 
        $vendor = Vendor::find($id);
        return view('vendor.create_vendor', [ 'title' => $title ,'vendor' => $vendor]);
     
    }

    public function store(Request $request){

        request()->validate([
            'company_name' => 'required',
            'f_name' => 'required',
            'l_name' => 'required',
            'phone' => 'required',
            'cnic' => 'required'
        ]);

        if( !request('vendor_id') ){
            $vendor = Vendor::create([
                'company_name'  => request('company_name'),
                'f_name' => request('f_name'),
                'l_name' => request('l_name'),
                'phone' => request('phone'),
                'cnic' => request('cnic'),
            ]);

            return back()->with('message', ucwords('Vendor Created Successfully'));

        } else {

            $vendor = Vendor::find(request('vendor_id'));
            $vendor->update($request->all());

            return redirect()->route('vendor.index')->with('success' , ucwords('Vendor Details Updated Successfully')); 

        }

     
    }

    public function destroy($id )
    {       
        $vendor = Vendor::find($id) ;
        $imagePath = public_path('images/vendors'.$vendor->image);


        if(\File::exists($imagePath)){
            \File::delete($imagePath);
        }

        $vendor->delete();
        return redirect()
            ->route('vendor.index')
            ->with('message', "Vendor Deleted Successfully");

    }





}

<?php

namespace restro\Http\Controllers;

use Illuminate\Http\Request;

// use Illuminate\Support\Facades\Storage;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use restro\Vendor;

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


    public function allVendorProducts($id)
    {
        $products = Vendor::find($id)->getAllProducts()->get();
        return  $products;
    }


    public function edit($id){
       
        $vendor = Vendor::find($id);
        return view('vendor.create_vendor', [ 'vendor' => $vendor]);
     
    }

    public function store(Request $request){

        request()->validate([
            'company_name' => 'required',
            'f_name' => 'required',
            'l_name' => 'required',
            'phone' => 'required',
            'cnic' => 'required'
        ]);

        if($request->id){

            $vendor = Vendor::find($request->id);
            $vendor->update($request->all());
            return back()->with('success' , ucwords('Vendor Details Updated Successfully')); 

        } else {

            $request->validate([
                'cnic' => 'required|unique:vendors,cnic'
            ]);

            $vendor = Vendor::create([
                'company_name'  => request('company_name'),
                'f_name' => request('f_name'),
                'l_name' => request('l_name'),
                'phone' => request('phone'),
                'cnic' => request('cnic'),
            ]);

            return back()->with('success', ucwords('Vendor Created Successfully'));

        }
     
    }

    public function destroy($id)
    {       
        $vendor = Vendor::find($id);
        if($vendor->with('getAllProducts')->get()->count() > 0 ){
           return back()->with('id',$vendor->id)->with('alert' , '" '.ucwords($vendor->f_name).' " contains raw items cannot deleted this vendor.Delete all raw items register against this user.' ) ; 
        }
        $vendor->delete();
        return redirect()->route('vendor.index')->with('message', "Vendor Deleted Successfully");
    }


    public function forceDelete($id)
    {
       
        $vendor = Vendor::find($id);
        $name = $vendor->f_name.''.$vendor->l_name;

        foreach($vendor->with('getAllProducts')->get() as $item){
            $item->delete();
        }

        $vendor->delete();

        return redirect()->route('vendor.index')->with('success' , 'Deleted all raw items related to '.$name);

    }





}

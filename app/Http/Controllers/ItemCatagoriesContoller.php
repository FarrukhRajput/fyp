<?php

namespace restro\Http\Controllers;

use Illuminate\Http\Request;

use restro\ItemCatagory;
class ItemCatagoriesContoller extends Controller
{   


    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $categories = ItemCatagory::all();
        return view('store.item_catagory')->withCategories($categories);
    }

    public function store(Request $request){

        $request->validate([
            'title' => 'required',        
        ]);

       
        $item_catagory = new ItemCatagory(); 

        if($request->id){
            $catagory = ItemCatagory::find($request->id);
            $catagory->title = strtolower(request('title'));
            $catagory->save();
            return back()->with('success','Category updated successfully');

        }else{
            $item_catagory->title = request('title');
            $item_catagory->save();
            return back()->with('success','Category created successfully');
        }
    }


    public function edit($id){
        $categories = ItemCatagory::all();    
        $category = ItemCatagory::find($id);

      
        return view('store.item_catagory')->withCategories($categories)->withCategory($category);
    }


    public function destroy($id)
    {
        $rawItem = ItemCatagory::find($id);

        if(count($rawItem->getAllProducts) > 0){
            return back()->with('id',$rawItem->id)->with('alert','Category contains raw items cannot deleted this category.'); 
        }

        $rawItem->delete();
        return back()->with('error','Category deleted successfully');
    }


    public function forceDelete($id)
    {
        $rawItem = ItemCatagory::find($id);
        
        foreach($rawItem->getAllProducts as $item){
           $item->delete();
        }

        $rawItem->delete();
        
        return back()->with('success' , 'Deleted all related raw items for this group');

        
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ItemCatagory;
class ItemCatagoriesContoller extends Controller
{   


    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $catagories = ItemCatagory::all();
        // dd($catagories);
        return view('store.item_catagory',[ 'items' => $catagories ]);
    }

    public function store(Request $request){
        $item_catagory = new ItemCatagory();

        $request->validate([
            'title' => 'required',        
        ]);

        if(request('catagory_id')){
            $catagory = ItemCatagory::find(request('catagory_id'));
            $catagory->title = strtolower(request('title'));
            $catagory->parent_catagory_id = request('parent_id');
            $catagory->save();
            return back()->with('success','Category updated successfully');

        }else{
            $item_catagory->title = request('title');
            $item_catagory->parent_catagory_id = request('parent_id');
            $item_catagory->save();
            return back()->with('success','Category created successfully');
        }
    }

    public function edit(ItemCatagory $catagory){
        $catagories = ItemCatagory::with('parent')->get();
        return view('store.item_catagory',['items'=>$catagories,'catagory'=>$catagory,'title' => 'Item Catagory' ,]);
    }

    public function destroy(ItemCatagory $catagory)
    {

        if($catagory->parent_catagory_id != 0){

            $allSubCatagories = ItemCatagory::all()->where('parent_catagory_id', '==' , $catagory->id);

            if( count($allSubCatagories) >= 1 ){
                
                foreach($allSubCatagories as $item){
                    $item->parent_catagory_id = 1;       
                    $item->save();
                }  
            }

            $catagory->delete();
        }

        
        return back()->with('error','Category deleted successfully');
    }
}

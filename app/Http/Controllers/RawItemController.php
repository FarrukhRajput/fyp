<?php

namespace restro\Http\Controllers;

use Illuminate\Http\Request;

use restro\Vendor;
use restro\ItemCatagory;
use restro\RawItem;

class RawItemController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $vendors = Vendor::all();
        $catagory = ItemCatagory::all();

        return view('store.raw_item', ['catagory' => $catagory  , 'vendors' => $vendors] );
    }


    public function store(Request $request) {

        $request->validate([
            'title' => 'required',
            'item_catagory' => 'required',
            'unit' => 'required',
            'vendor_id' => 'required'
        ]);
    
        if($request->id){
            $rawItem = RawItem::find($request->id);
            $rawItem->title = $request->title;
            $rawItem->catagory_id = $request->item_catagory;
            $rawItem->vendor_id = $request->vendor_id;
            $rawItem->measuring_unit = $request->unit;
            $rawItem->reorder_level = $request->reorder_level;
            $rawItem->reorder_qty = $request->reorder_qty;
            $rawItem->save();
            return redirect()->route('rawItem.all')->with('success' , "Store Item Updated Successfully");
        }else{

            $rawItem = new RawItem;       
            $rawItem->title = $request->title;
            $rawItem->catagory_id = $request->item_catagory;
            $rawItem->vendor_id = $request->vendor_id;
            $rawItem->measuring_unit = $request->unit;
            $rawItem->reorder_level = $request->reorder_level;
            $rawItem->reorder_qty = $request->reorder_qty;
            $rawItem->save();
            return back()->with('success' , "Store Item Created Successfully");
        }

       
    }

    public function all(){
        $rawItems = RawItem::with(['catagory'])->get();
        return view('store.all_raw_items' , ['rawItems' => $rawItems]);
    }


    public function edit(RawItem $rawItem , $id){
        $catagory = ItemCatagory::all();
        $rawItems = RawItem::find($id);
        return view('store.raw_item',[
            'item' => $rawItems, 
            'title' => 'Edit Raw Item',
            'catagory' => $catagory ]
        );
    }


    public function destroy(RawItem $rawItem ,$id){
        $rawItem->find($id)->delete();
        return back()->with('success', 'Item Deleted Successfully');
    }

   

  
}

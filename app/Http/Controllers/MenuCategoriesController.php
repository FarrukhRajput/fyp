<?php

namespace restro\Http\Controllers;

use restro\MenuCategory;
use Illuminate\Http\Request;

class MenuCategoriesController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        // $categories = MenuCategory::with(['parent'])->get();
        $categories = MenuCategory::all();

        // dd($categories);

        // dd($categories);
        return view('menu.category' , [
            'categories' => $categories
        ]);
    }


    public function store(Request $request)
    {   
        $request->validate([
            'title' => 'required',
        ]);
           
        
        if($request->id){
            $this->update($request);
            return back()->with('success' , 'Menu Category Updated Succesfully');
        }

        $category = new  MenuCategory();
        $category->title = $request->title;
        $category->save();

        return back()->with('success', 'Menu Category Created Sucessfully');
    }


   
    public function edit($id)
    {
        $categories = MenuCategory::all();
        $category = MenuCategory::findOrFail($id);

        return view('menu.category',[
            'category' => $category,
            'categories' => $categories
        ]);
    }

    
    public function update($request)
    {   
    
        $category = MenuCategory::findOrFail($request->id);
        $category->update($request->all());
    }


    public function destroy($id)
    {
        
        $category = MenuCategory::find($id);

        if($category->getMenuProducts->count() == 0){
            $category->delete();
            return back()->with('success','Menu Category Deleted Successfully.');
        }

        else{
            return back()->with('id', $category->id)->with('alert', '" '.ucwords($category->title).' " contains some products, Please, delete all its Products before deleting it.');
        }
    }   

    public function forceDelete($id)
    {
        $group = MenuCategory::find($id);

        foreach ($group->getMenuProducts as $item) {
            $item->delete();
        }

        $group->delete();
        return redirect()->route('menuCatagory.index')->with('success' , 'Deleted all products related to this menu category');
       
    }
    
}

<?php

namespace App\Http\Controllers;

use App\MenuCategory;
use Illuminate\Http\Request;

class MenuCategoriesController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = MenuCategory::with(['parent'])->get();

        return view('menu.all_categories' , [
            'categories' => $categories
        ]);
    }


    public function create()
    {
        $categories = MenuCategory::with(['parent'])->get();
        
        return view('menu.category' , [
            'categories' => $categories
        ]);
       
    }

    public function store()
    {
        $category = new  MenuCategory();
        $category->title = request('title');
        $category->parent_category_id = request('parent_category_id');
        $category->save();

        return back()->with('message', 'Category Created Sucessfully');
    }

 
    public function show()
    {
        
    }

   
    public function edit($id)
    {
        $categories = MenuCategory::with(['parent'])->get();
        $category = MenuCategory::findOrFail($id);

        return view('menu.edit_category',[
            'category' => $category,
            'categories' => $categories
        ]);
    }

    
    public function update($id)
    {   
        $selectedParentId = MenuCategory::find(request('parent_category_id'));
        $category = MenuCategory::findOrFail($id);
  
        if($category->id == request('parent_category_id')){
           return back()->with( 'error' , "Category cannot be the parent of itself");
        }
        
        else if( request('parent_category_id') != 0  ){

            if($category->id ==  $selectedParentId->parent_category_id){
                return back()->with( 'error' , "One Category Is Already The Parent Of Other Category");
            }
            
            else{
                $category->title = request('title');
                $category->parent_category_id = request('parent_category_id');
                $category->save();
        
                return view('menu.all_categories')->with('message' , 'Category Updated Successfully');
            }
        }
    }


    public function destroy($id)
    {
        $parentCategory = MenuCategory::where('parent_category_id', $id)->count();

        if($parentCategory > 0){
            return  back()->with('delete' , 'Cannot Delete Parent Category');
        }
        $category = MenuCategory::find($id);
        $category->delete();
        return redirect()->route('menuCatagory.index')->with('delete' , 'Category Deleted Successfully');
    }   
    
}

<?php

namespace App\Http\Controllers;

use App\Product;
use App\MenuCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    public function show(   )
    {
        $products = Product::with('getCategory')->with('parentCategory')->get();

 
        return view('product.product')->withProducts($products);

    }

    public function create()
    {
        $category =  MenuCategory::all()->where('parent_category_id', '!=', 0);
        return view('product.product_form' , [ "category" =>  $category]);
    }


    public function store(Request $request)
    {
        $product = new Product();

        // dd($request->all());

        if($request->image){
            $imageName = $request->title.'_'.time().'.'.$request->file('image')->getClientOriginalExtension();  
         
            $destinationPath = public_path('images/products');
            request()->image->move($destinationPath, $imageName); 
            $imagePath = $destinationPath.'/'.$imageName;
        }
        
        else{
            $imagePath =  'images/product-image.jpg';
        }  

        $product->menu_category_id  = $request->menu_category_id;
        $product->is_active = $request->is_active  == "on" ? true : false ;
        $product->title =  $request->title;
        $product->price = $request->price;
    
        $product->save();

        // dd($request->all());
    
       
    }



}

<?php

namespace restro\Http\Controllers;

use restro\Product;
use restro\MenuCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    public function show()
    {
        $products = Product::all();
     
        if(request()->expectsJson()) {
            return response()->json($products);
        }

        $products = Product::with('getCategory')->with('parentCategory')->get();

      
        return view('product.product')->withProducts($products);

    }

    public function create()
    {
        $category =  MenuCategory::all();
        return view('product.product_form' , [ "category" =>  $category]);
    }


    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'menu_category_id' => 'required'
        ]);


        if(@$request->id){
            $this->update($request);
            return back()->with('success' , 'Product Updated Succesfully');
        }

    

        $product = new Product();
        $imagePath  = "images/products/";
        // renaming the uploaded file
        if($request->file('image')){
            $imageName = time().'.'.$request->file('image')->getClientOriginalExtension();  
            $destinationPath = public_path('images/products');
            request()->image->move($destinationPath, $imageName); 
            $imagePath = $imagePath.$imageName;
            $product->image =  $imagePath;
        }
        
        else{
            $imagePath =  'images/product-image.jpg';
            $product->image =  $imagePath;
        }  

        $product->menu_category_id  = $request->menu_category_id;
        $product->is_active = $request->is_active  == "on" ? true : false ;
        $product->title =  $request->title;
        $product->price = $request->price;
    
    
        $product->save();

        return redirect()->route('products.all')->with('success', 'product save successfully');
    
    }


    public function edit($id){

        $category =  MenuCategory::all();
        $product = Product::find($id);

        return view('product.product_form')->withProduct($product)->withCategory($category);

    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return back()->with('success' , 'Product Deleted Succesfully');
    }


    public function update($request)
    {
        $product = Product::find($request->id);        
        $directoryPath  = "images/products/";
        // renaming the uploaded file
        if($request->file('image')){
            $imageName = time().'.'.$request->file('image')->getClientOriginalExtension();  
            $destinationPath = public_path('images/products');
            request()->image->move($destinationPath, $imageName); 
            $imagePath = $directoryPath.$imageName;
            dd($imagePath);
            $product->image =  $imagePath;
        }

        $product->title =  $request->title;
        $product->price = $request->price;    
        $product->menu_category_id  = $request->menu_category_id;
        $product->is_active = $request->is_active  == "on" ? true : false ;
        $product->save();
       
    }


}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Log;
//use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index(){
      

        $allPost = Product::all();

      return $allPost;
       //return ProductResource::collection($allPost);

    }
    public function show($id){
        $post = Product::find($id);
      
     return $post;
        //return new ProductResource($post);
    }
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName); // Store the image in the 'public/images' directory
            $data['image'] = $imageName; // Update the 'image' field with the image path
        }
           // Log the debug output
           //Log::info('Request Data:', $request->all());
           
           Log::info('Name: ' . $data['name']);
           Log::info('Image Path: ' . $data['image']); // Check if the image path is correct

        $product = Product::create($data);

    log::info($product);
        return response()->json(['message' => 'Product created successfully', 'data' => $product], 201);
    }
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        Log::info('Product ID: ' . $id);
        Log::info('Request Data:', $request->all());
        
    
        
    
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    
        // Validate and process the request data
        // $data = $request->validate([
        //     'name' => ['required', 'string'],
        //     'price' => ['required', 'numeric'],
        //     'description' => ['required', 'string'],
        //     'category' => ['string'],
        // ]);
        $data =$request->validated();
        
    
        // Check if a new image file is provided in the request
        if ($request->hasFile('image')) {
            // Handle image upload
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName); // Store the image in the 'public/images' directory
            $data['image'] = $imageName; // Update the 'image' field with the new image path
        }
    
        // Log the request data and updated product data
        // Log::info('Request Data:', $request->all());
        // Log::info('Updated Product Data:', $data);
        // Log::info('Updated Image Path: ' . ($data['image'] ?? 'No Image Provided'));
    
        // Update the product data
        $product->update($data);
    
        return response()->json(['message' => 'Product updated successfully', 'data' => $product]);
    }
    
    
    
    
    public function destroy($id)
    {
        $product = Product::find($id);
    
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
    
        $product->delete();
    
        return response()->json(['message' => 'Product deleted successfully']);
    }
            
}

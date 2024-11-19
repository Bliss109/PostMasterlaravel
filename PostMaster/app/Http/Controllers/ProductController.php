<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; //Import the Product Model to interact with the database

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * This method fetched all products from the database, orders them by creation date
     * and passes the data to the products.index view for display
     */
    public function index()
    {
        $product = Product::orderBy('created_at', 'DESC')->get();
  
        return view('products.index', compact('product'));
    }
    

    /**
     * Show the form for creating a new resource.
     * The method returns a view with a form to create a new product.
     */
    public function create()
    {
        return view('products.create'); //Load the create product form view
    }

    /**
     * Store a newly created resource in storage.
     * Handles form submission for creating a new product
     * It validates and saves the data to the database and redirects with a success maessage
     */
    public function store(Request $request)
    {
        Product::create($request->all());
 
        return redirect()->route('products')->with('success', 'Product added successfully');
    }
    

    /**
     * Display the specified resource.
     * Displays a single product by its ID
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
  
        return view('products.show', compact('product'));
    }
    

    /**
     * Show the form for editing the specified resource.
     * Fetches a product by its ID and returns a view to edit it
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
  
        return view('products.edit', compact('product'));
    }
    

    /**
     * Update the specified resource in storage.
     * Handles submission of the edit form and updates the product in the database
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
  
        $product->update($request->all());
  
        return redirect()->route('products')->with('success', 'product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * Deletes a product by its ID from the database
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
  
        $product->delete();
  
        return redirect()->route('products')->with('success', 'product deleted successfully');
    }
    
}

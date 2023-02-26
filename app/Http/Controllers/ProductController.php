<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $PrepareProduct = [
            'name' => $request->name,
            'price' => $request->price,
            'user_id' => Auth::id()
        ];
        $product = Product::create($PrepareProduct);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $PrepareProduct = [
            'name' => $request->name,
            'price' => $request->price,
            'user_id' => Auth::id()
        ];
        $productInt = Product::find($product->id);
        $productInt->update($PrepareProduct);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $productInt = Product::find($product->id);
        $productInt->delete();
        return redirect()->route('products.index');

    }
}

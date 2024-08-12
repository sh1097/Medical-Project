<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\MedicalShop;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('medicalShop')->get(); // Assuming you have a relationship with MedicalShop
        return view('product.index', compact('products'));
    }
    
    public function create()
    {
        $shops = MedicalShop::all();
        return view('product.create', compact('shops'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'medical_shop_id' => 'required|exists:medical_shops,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);
    
        Product::create($request->all());
        return redirect()->route('products.index');
    }
    
    public function edit(Product $product)
    {
        $shops = MedicalShop::all();
        return view('products.edit', compact('product', 'shops'));
    }
    
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'medical_shop_id' => 'required|exists:medical_shops,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);
    
        $product->update($request->all());
        return redirect()->route('products.index');
    }
    
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
    
}

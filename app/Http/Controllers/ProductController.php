<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index(){
        $products = Product::latest()->get();
        return Inertia::render('products/Index', compact('products'));
    }
    public function create(){
        return Inertia::render('products/Create', []);
    }
    public function store(Request $request){
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'subject'=>'required|string|max:255',
            'score'=>'required|numeric|min:0|max:100',
        ]);

        Product::create($data);

        return redirect()->route('products.index')->with('message','Product Added Succesfully');
    }

    public function edit(Product $product){
        return Inertia::render('products/Edit', compact('product'));
    }
    public function update(Request $request, Product $product){
        $request->validate([
            'name'=>'required|string|max:255',
            'subject'=>'required|string|max:255',
            'score'=>'required|numeric|min:0|max:100',
        ]);
        $product->update([
            'name'=> $request->input('name'),
            'subject'=> $request->input('subject'),
            'score'=> $request->input('score'),
        ]);

        return redirect()->route('products.index')->with('message','product updated succesfully');
    }

    public function destroy(Product $product){
        $product->delete();
        return redirect()->route('products.index')->with('message','product deleted succesfully');
    }
}

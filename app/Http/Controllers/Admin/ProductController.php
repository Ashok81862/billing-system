<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['unit'])->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::get();

        return view('admin.products.create', compact('units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          =>  ['required','max:50'],
            'price'         =>  ['required','integer'],
            'sale_price'    =>  ['nullable','integer'],
            'body'          =>  ['nullable'],
            'unit_id'       =>  ['required','exists:units,id']
        ]);

        Product::create([
            'name'      =>    $request->name,
            'price'     =>    $request->price,
            'sale_price'=>    $request->sale_price ? $request->sale_price : 0 ,
            'body'      =>    $request->body,
            'unit_id'=>    $request->unit_id,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'New Product has been created successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $units = Unit::get();

        return view('admin.products.edit', compact('units', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'          =>  ['required','max:50'],
            'price'         =>  ['required','integer'],
            'sale_price'    =>  ['nullable','integer'],
            'body'          =>  ['nullable'],
            'unit_id'       =>  ['required','exists:units,id']
        ]);

        $product->update([
            'name'      =>    $request->name,
            'price'     =>    $request->price,
            'sale_price'=>    $request->sale_price,
            'body'      =>    $request->body,
            'unit_id'=>    $request->unit_id,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product has been updated successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product has been deleted successfully !!');
    }
}

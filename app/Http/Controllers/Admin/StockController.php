<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::with(['product'])->paginate(10);

        return view('admin.stocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::select(['id','name','price'])->get();

        return view('admin.stocks.create', compact('products'));
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
            'product_id'    =>  ['required','exists:products,id'],
            'quantity'      =>  ['required','integer'],
            'remark'        =>  ['nullable'],
        ]);

        Stock::create([
            'product_id'    =>  $request->product_id,
            'quantity'      =>  $request->quantity,
            'remark'        =>  $request->remark
        ]);

        return redirect()->route('admin.stocks.index')
            ->with('success', 'New Stock has been created successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        return view('admin.stocks.show', compact('stock'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        $products = Product::select(['id','name','price'])->get();

        return view('admin.stocks.edit', compact('products','stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'product_id'    =>  ['required','exists:products,id'],
            'quantity'      =>  ['required','integer'],
            'remark'        =>  ['nullable'],
        ]);

        $stock->update([
            'product_id'    =>  $request->product_id,
            'quantity'      =>  $request->quantity,
            'remark'        =>  $request->remark
        ]);

        return redirect()->route('admin.stocks.index')
            ->with('success', 'Stock has been updated successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();


        return redirect()->route('admin.stocks.index')
            ->with('success', 'Stock has been deleted successfully !!');
    }
}

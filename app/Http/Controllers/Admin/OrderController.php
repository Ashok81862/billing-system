<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with(['product','customer'])->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::select(['id','name','price'])->get();

        $customers = Customer::select(['id','name'])->get();

        return view('admin.orders.create', compact('products', 'customers'));
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
            'customer_id'   =>  ['nullable','exists:customers,id'],
            'product_id'    =>  ['required','exists:products,id'],
            'quantity'      =>  ['required','integer'],
        ]);

        Order::create([
            'customer_id'   =>  $request->customer_id,
            'product_id'    =>  $request->product_id,
            'quantity'      =>  $request->quantity,
        ]);

        return redirect()->route('admin.orders.index')
            ->with('success', 'New Order has been created successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $products = Product::select(['id','name','price'])->get();

        $customers = Customer::select(['id','name'])->get();

        return view('admin.orders.edit', compact('products', 'customers','order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_id'   =>  ['nullable','exists:customers,id'],
            'product_id'    =>  ['required','exists:products,id'],
            'quantity'      =>  ['required','integer'],
        ]);

        $order->update([
            'customer_id'   =>  $request->customer_id,
            'product_id'    =>  $request->product_id,
            'quantity'      =>  $request->quantity,
        ]);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order has been updated successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order has been deleted successfully !!');
    }
}

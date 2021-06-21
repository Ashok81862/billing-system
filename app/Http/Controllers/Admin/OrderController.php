<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\CustomerCredit;
use App\Models\CustomerPayment;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with(['Product','orderProducts'])->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::select(['id','name','price','on_sale', 'sale_price'])->get();

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
            'customer_id' => 'nullable|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:0',
        ]);


        $order = Order::create([
            'customer_id'   =>  $request->customer_id,
        ]);

        $this->putProduct($order, $request);
        $this->calculateTotal($order);


        return redirect()->route('admin.orders.edit', $order->id)
            ->with('success', 'New Order has been created successfully, Your can add more products !!');
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
        $orderProducts = OrderProduct::with('product')->where('order_id', $order->id)->get();
        $customer = $order->customer_id ? $order->customer : false;

        $customers = Customer::select(['id','name'])->get();

        return view('admin.orders.edit', compact('products','customer', 'customers','order','orderProducts'));
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

    /**
     * Put product into Order
     *
     * @param Order $order
     * @param Request $request
     * @return bool|string
     */
    protected function putProduct(Order $order, Request $request)
    {
        // Check if that item is on orderProduct
        $check = OrderProduct::where([
            'order_id' => $order->id,
            'product_id' => $request->product_id,
        ])->first();

        if ($check) {
            $check->quantity += $request->quantity;
            $check->save();
            return "Increment";
        }

        // If not, add it to orderProduct
        $product = Product::find($request->product_id);
        $unit_price = $product->on_sale ? $product->sale_price : $product->price;

        // Save OrderProduct
        $order->orderProducts()->create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'unit_price' => $unit_price,
        ]);

        return true;
    }

    /**
     * Calculate Total and Subtotal of Order
     *
     * @param Order $order
     */
    protected function calculateTotal(Order $order)
    {
        $total = 0;
        foreach ($order->orderProducts as $op) {
            $total += (float)$op->unit_price * (float)$op->quantity;
        }

        $order->sub_total = $total;
        $order->total = $total - $order->discount;
        $order->save();
    }

    /**
     * Update Quantity of Order Product
     *
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateQuantity(Request $request, Order $order)
    {
        if ($this->checkPending($order)) return back();

        $request->validate([
            'order_product_id' => 'required|exists:order_product,id',
            'quantity' => 'required|numeric|min:0'
        ]);

        $orderProduct = OrderProduct::find($request->order_product_id);

        $orderProduct->quantity = $request->quantity;
        $orderProduct->save();

        $this->calculateTotal($order);

        return redirect()
            ->route('admin.orders.edit', $order->id)
            ->with('success', 'Quantity has been updated on the order!');
    }

    /**
     * Add Product to Order
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addProduct(Request $request, Order $order)
    {
        if ($this->checkPending($order)) return back();

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:0'
        ]);

        $checking = $this->putProduct($order, $request);
        $this->calculateTotal($order);

        if ($checking == "Increment")
            return redirect()
                ->route('admin.orders.edit', $order->id)
                ->with('success', "{$request->quantity} has been added to product in order!");

        return redirect()
            ->route('admin.orders.edit', $order->id)
            ->with('success', 'Product has been added to the order!');
    }

    /**
     * Remove Product from Order
     *
     * @param OrderProduct $orderProduct
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeProduct(Order $order, OrderProduct $orderProduct)
    {
        if ($this->checkPending($order)) return back();

        $orderProduct->delete();
        $this->calculateTotal($order);

        return redirect()
            ->route('admin.orders.edit', $order->id)
            ->with('success', 'Product has been removed from order!');
    }

    public function discount(Request $request, Order $order)
    {
        if ($this->checkPending($order)) return back();

        $request->validate([
            'discount' => 'required|numeric|min:0|max:' . $order->sub_total,
        ]);

        $order->discount = $request->discount;
        $order->save();

        $this->calculateTotal($order);

        return redirect()
            ->route('admin.orders.edit', $order->id)
            ->with('success', 'Discount amount has been updated!');
    }

    public function final(Request $request, Order $order)
    {
        if ($this->checkPending($order)) return back();

        $request->validate([
            'payment_method' => ['required', Rule::in(['Cash', 'Cheque', 'Card', 'Electronic'])],
            'payment_amount' => ['required', 'numeric', 'lte:' . $order->total],
            'remarks' => ['nullable'],
        ]);

        $sale = Sale::create([
            'order_id' => $order->id,
            'payment_method' => $request->payment_method,
            'remarks' => $request->remarks,
            'total' => $order->total,
        ]);

        ///check for customer credit.

        if ($request->payment_amount < $order->total && !empty($order->customer_id)) {
            $cC = CustomerCredit::create([
                'customer_id' => $order->customer_id,
                'sale_id' => $sale->id,
                'total_amount' => $order->total
            ]);

            CustomerPayment::create([
                'customer_credit_id' => $cC->id,
                'paid_amount' => $request->payment_amount,
                'payment_method' => $request->payment_method,
                'remarks' => 'Initial Payment'
            ]);
        }

        // Remove from Stock
        foreach ($order->orderProducts as $op) {
            Stock::create([
                'user_id' => auth()->user()->id,
                'product_id' => $op->product_id,
                'quantity' => -$op->quantity,
                'remarks' => "order_sales:" . $order->id,
            ]);
        }

        $order->update(['status' => 'Complete']);

        return redirect()
            ->route('admin.orders.edit', $order->id)
            ->with('success', 'Order has been completed successfully!');
    }

    public function cancel(Order $order)
    {
        $order->status = "Canceled";
        $order->save();

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order has been canceled!');
    }

    /**
     * Check If the order is Pending or Not
     *
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse|boolean
     */
    protected function checkPending(Order $order)
    {
        if ($order->status != "Pending")
            return redirect()
                ->route('admin.orders.edit', $order->id)
                ->with('error', 'You cannot modify orders marked as complete!');

        return false;
    }

    /**
     * Edit Customer in Order to Order
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignCustomer(Request $request, Order $order)
    {
        if ($this->checkPending($order)) return back();

        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
        ]);

        $order->update($data);

        return redirect()
            ->route('admin.orders.edit', $order->id)
            ->with('success', 'Customer has been added on this order!');
    }

    /**
     * Create New Customer and Assign to Order
     * @param StoreCustomerRequest $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createCustomerAndAssign(Request $request, Order $order)
    {
        if ($this->checkPending($order)) return back();

        $data = $request->validate([
            'name'          =>  ['required','max:50'],
            'reg_number'    =>   ['required','unique:customers,reg_number','integer'],
            'remark'        =>  ['nullable'],
            'address'       =>  ['required','string'],
            'phone'       =>  ['required'],
        ]);

        $customer = Customer::create($data);

        // Assign Customer to Order
        $order->update([
            'customer_id' => $customer->id,
        ]);

        return redirect()
            ->route('admin.orders.edit', $order->id)
            ->with('success', 'New Customer has been added and assigned on this order!');
    }

    /**
     * Un-Assign Customer from Order
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeCustomer(Order $order)
    {
        if ($this->checkPending($order)) return back();

        $order->update(['customer_id' => null]);

        return redirect()
            ->route('admin.orders.edit', $order->id)
            ->with('success', 'Customer has been removed from this order!');
    }



}

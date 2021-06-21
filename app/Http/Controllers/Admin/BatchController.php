<?php

namespace App\Http\Controllers\Admin;

use App\Models\Batch;
use App\Models\Stock;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\BatchProduct;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batches = Batch::with(['batchProducts:id,batch_id,quantity', 'vendor:id,name'])
        ->paginate(10);

        return view('admin.batches.index', compact('batches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = Vendor::select(['id','name'])->get();

        return view('admin.batches.create', compact('vendors'));
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
            'name'      =>  ['nullable','string'],
            'vendor_id' =>  ['required','exists:vendors,id']
        ]);

        $batch = Batch::create([
        'name'      =>  $request->name,
        'vendor_id' =>  $request->vendor_id,
        'user_id'   =>  auth()->id(),
        ]);

        return redirect()->route('admin.batches.edit', $batch->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Batch $batch)
    {
        $products = Product::all();

        return view('admin.batches.edit', compact('batch','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Batch $batch)
    {
        $request->validate([
            'name' => 'nullable'
        ]);

        $batch->update($request->only(['name']));

        return redirect()->route('admin.batches.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Add Product to the Batch
     *
     * @param Request $request
     * @param Batch $batch
     * @return \Illuminate\Http\Response
     */
    public function addProduct(Request $request, Batch $batch)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
            'unit_price' => 'required|numeric|min:0',
        ]);

        // Insert Product
        $batch->batchProducts()->create($request->only(['product_id', 'quantity', 'unit_price']));

        $this->batchUpdate($batch);

        return redirect()->route('admin.batches.edit', $batch->id)
            ->with('success', 'Product has been added to Batch');
    }

    /**
     * Remove Product from the Batch
     *
     * @param BatchProduct $batchProducts
     * @param Batch $batch
     * @return \Illuminate\Http\Response
     */
    public function removeProduct($bid, $bp)
    {
        $batchProduct = BatchProduct::findOrFail($bp);

        $batchProduct->delete();

        $this->batchUpdate(Batch::find($bid));

        return redirect()->route('admin.batches.edit', $bid)
        ->with('success', 'Product has been removed to Batch');
    }

    /**
     * Calculate Batch Total Price Every Time Change Happens
     * @param Batch $batch
     */
    private function batchUpdate(Batch $batch)
    {
        $total = 0;

        $batchProduct = $batch->batchProducts;

        foreach ($batchProduct as $b) {
            $total += $b->unit_price * $b->quantity;
        }

        $batch->total = $total;
        $batch->save();
    }

    /**
     * Complete
     * @param Request $request
     * @param Batch $batch
     */
    public function completeBatch(Request $request, Batch $batch)
    {
        $total = $batch->total;

        $request->validate([
            'payment_amount' => 'required|numeric|lte:'. $total,
            'payment_method' => ['required', Rule::in(['Cash', 'Cheque', 'Card', 'Electronic'])],
            'remarks' => 'nullable|max:500',
        ]);

        if($request->payment_amount < $total) {
            // Difference
            $to_pay = $total - $request->payment_amount;

            // Add this to VendorCredit and add Payment to Vendor Payment
        }


        // Do stock things
        $stock_data = [];
        foreach($batch->batchProducts as $prod) {
            $stock_data[] = [
                'product_id' => $prod->product_id,
                'quantity' => $prod->quantity,
                'remarks' => 'Batch:'.$batch->id,
                'user_id' => auth()->user()->id,
            ];
        }

        Stock::insert($stock_data); // save to db

        $batch->update([
            'is_complete' => true,
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->route('admin.batches.edit', $batch->id)
            ->with('success', 'Batch has been completed');
    }

    public function checkComplete(Batch $batch)
    {
        if($batch->is_complete)
            return redirect()->route('admin.batches.edit', $batch->id)
            ->with('success', 'You cannot modify as batch has been completed');
    }

}

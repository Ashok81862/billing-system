<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::with(['customer'])->paginate(10);

        return view('admin.vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::select(['id','name'])->get();

        return view('admin.vendors.create', compact('customers'));
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
            'reg_number'    =>   ['required','unique:vendors,reg_number','integer'],
            'remark'        =>  ['nullable'],
            'address'       =>  ['nullable','string'],
            'phone'         =>  ['required'],
            'category_id'   =>  ['required','exits:categories,id'],
        ]);

        Vendor::create([
            'name'          =>  $request->name,
            'reg_number'    =>  $request->reg_number,
            'remark'        =>  $request->remark,
            'address'       =>  $request->address,
            'phone'         =>  $request->phone,
            'category_id'   =>  $request->category_id
        ]);

        return redirect()
            ->route('admin.vendors.index')
            ->with('success','New Vendor has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        return view('admin.vendors.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        $customers = Customer::select(['id','name'])->get();

        return view('admin.vendors.edit', compact('customers','vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'name'          =>  ['required','max:50'],
            'reg_number'    =>   ['required','unique:vendors,reg_number','integer'],
            'remark'        =>  ['nullable'],
            'address'       =>  ['nullable','string'],
            'phone'         =>  ['required'],
            'category_id'   =>  ['required','exits:categories,id'],
        ]);

        $vendor->update([
            'name'          =>  $request->name,
            'reg_number'    =>  $request->reg_number,
            'remark'        =>  $request->remark,
            'address'       =>  $request->address,
            'phone'         =>  $request->phone,
            'category_id'   =>  $request->category_id
        ]);

        return redirect()
            ->route('admin.vendors.index')
            ->with('success','New Vendor has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}

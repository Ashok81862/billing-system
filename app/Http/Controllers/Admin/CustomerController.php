<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::select(['id','name','phone','reg_number','address','remark'])->paginate(10);

        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customers.create');
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
            'reg_number'    =>   ['required','unique:customers,reg_number','integer'],
            'remark'        =>  ['nullable'],
            'address'       =>  ['required','string'],
            'phone'       =>  ['required'],
        ]);

        Customer::create([
            'name'          =>  $request->name,
            'reg_number'    =>  $request->reg_number,
            'remark'       =>  $request->remark,
            'address'       =>  $request->address,
            'phone'       =>  $request->phone,
        ]);

        return redirect()
            ->route('admin.customers.index')
            ->with('success','New Customer has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name'          =>  ['required','max:50'],
            'reg_number'    =>   ['required','unique:customers,reg_number,'.$customer->id,'integer'],
            'remark'        =>  ['nullable'],
            'address'       =>  ['required','string'],
            'phone'       =>  ['required'],
        ]);

        $customer->update([
            'name'          =>  $request->name,
            'reg_number'    =>  $request->reg_number,
            'remark'       =>  $request->remark,
            'address'       =>  $request->address,
            'phone'       =>  $request->phone,
        ]);

        return redirect()
            ->route('admin.customers.index')
            ->with('success','Customer has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()
            ->route('admin.customers.index')
            ->with('success','Customer has been deleted successfully');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::paginate(10);

        return view('admin.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employees.create');
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
            'phone'         =>  ['nullable'],
            'address'       =>  ['required'],
            'pan_number'    =>  ['required'],
            'salary'        =>  ['required'],
            'position'      =>  ['required'],
        ]);

        Employee::create([
            'name'          =>  $request->name,
            'phone'         =>  $request->phone,
            'address'       =>  $request->address,
            'pan_number'    =>  $request->pan_number,
            'salary'        =>  $request->salary,
            'position'      =>  $request->position
        ]);

        return redirect()->route('admin.employees.index')
            ->with('success', 'New Employee has been created successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('admin.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name'          =>  ['required','max:50'],
            'phone'         =>  ['nullable'],
            'address'       =>  ['required'],
            'pan_number'    =>  ['required'],
            'salary'        =>  ['required'],
            'position'      =>  ['required'],
        ]);

        $employee->update([
            'name'          =>  $request->name,
            'phone'         =>  $request->phone,
            'address'       =>  $request->address,
            'pan_number'    =>  $request->pan_number,
            'salary'        =>  $request->salary,
            'position'      =>  $request->position
        ]);

        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee has been updated successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('admin.employees.index')
            ->with('success','Employee has been deleted successfully !!');
    }
}

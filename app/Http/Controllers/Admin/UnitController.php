<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::paginate(10);

        return view('admin.units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'singular_name' =>  ['required','max:50'],
            'plural_name'   =>  ['nullable'],
            'singular_abbr' =>  ['required'],
            'plural_abbr'   =>  ['nullable'],
        ]);

        Unit::create([
            'singular_name' =>  $request->singular_name,
            'plural_name'   =>  $request->plural_name,
            'singular_abbr' =>  $request->singular_abbr,
            'plural_abbr'   =>  $request->plural_abbr,
        ]);

        return redirect()->route('admin.units.index')
            ->with('success', 'New Unit has been created successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        return view('admin.units.show', compact('unit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        return view('admin.units.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'singular_name' =>  ['required','max:50'],
            'plural_name'   =>  ['nullable'],
            'singular_abbr' =>  ['required'],
            'plural_abbr'   =>  ['nullable'],
        ]);

        $unit->update([
            'singular_name' =>  $request->singular_name,
            'plural_name'   =>  $request->plural_name,
            'singular_abbr' =>  $request->singular_abbr,
            'plural_abbr'   =>  $request->plural_abbr,
        ]);

        return redirect()->route('admin.units.index')
            ->with('success', 'Unit has been updated successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();

        return redirect()->route('admin.units.index')
        ->with('success', 'Unit has been deleted successfully !!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogisticType;
use Illuminate\Http\Request;

class LogisticTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logisticTypes = LogisticType::select(['id','name'])->paginate(10);

        return view('admin.logistics.types.index', compact('logisticTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.logistics.types.create');
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
            'name'  =>  ['required','max:50'],
        ]);

        LogisticType::create([
            'name'  =>  $request->name,
        ]);

        return redirect()->route('admin.logisticTypes.index')
            ->with('success', 'New LogisticType has been created successfully !! ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(LogisticType $logisticType)
    {
        return view('admin.logisticTypes.show', compact('logisticType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(LogisticType $logisticType)
    {
        return view('admin.logistics.types.edit', compact('logisticType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LogisticType $logisticType)
    {
        $request->validate([
            'name'  =>  ['required','max:50'],
        ]);

        $logisticType->update([
            'name'  =>  $request->name,
        ]);

        return redirect()->route('admin.logisticTypes.index')
            ->with('success', 'LogisticType has been updated successfully !! ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LogisticType $logisticType)
    {
        $logisticType->delete();

        return redirect()->route('admin.logisticTypes.index')
        ->with('success', 'LogisticType has been deleted successfully !! ');
    }
}

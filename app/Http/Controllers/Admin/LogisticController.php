<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logistic;
use App\Models\LogisticType;
use Illuminate\Http\Request;

class LogisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logistics = Logistic::select(['id','amount','logistic_type_id','remark'])->paginate(10);

        return view('admin.logistics.index', compact('logistics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $logisticTypes = LogisticType::select(['id','name'])->get();

        return view('admin.logistics.create', compact('logisticTypes'));
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
            'amount'            =>  ['required','max:50'],
            'logistic_type_id' =>  ['required','exists:logistic_types,id'],
            'remark'            =>  ['nullable'],
        ]);

        Logistic::create([
            'amount'            =>  $request->amount,
            'logistic_type_id' =>  $request->logistic_type_id,
            'remark'            =>  $request->remark,
        ]);

        return redirect()->route('admin.logistics.index')
            ->with('success', 'New Logistic has been created successfully !! ');
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
    public function edit(Logistic $logistic)
    {
        $logisticTypes = LogisticType::select(['id','name'])->get();

        return view('admin.logistics.edit', compact('logistic','logisticTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logistic $logistic)
    {
        $request->validate([
            'amount'            =>  ['required','max:50'],
            'logistic_type_id' =>  ['required','exists:logistic_types,id'],
            'remark'            =>  ['nullable'],
        ]);

        $logistic->update([
            'amount'            =>  $request->amount,
            'logistic_type_id' =>  $request->logistic_type_id,
            'remark'            =>  $request->remark,
        ]);
        return redirect()->route('admin.logistics.index')
            ->with('success', 'Logistic has been updated successfully !! ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logistic $logistic)
    {
        $logistic->delete();

        return redirect()->route('admin.logistics.index')
            ->with('success', 'Logistic has been deleted successfully !! ');
    }
}

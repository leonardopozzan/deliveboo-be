<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Addition;
use App\Http\Requests\StoreAdditionRequest;
use App\Http\Requests\UpdateAdditionRequest;

class AdditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addition = Addition::paginate(10);
        return view('admin.additions.index', compact('addition'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdditionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdditionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Addition  $addition
     * @return \Illuminate\Http\Response
     */
    public function show(Addition $addition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Addition  $addition
     * @return \Illuminate\Http\Response
     */
    public function edit(Addition $addition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdditionRequest  $request
     * @param  \App\Models\Addition  $addition
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdditionRequest $request, Addition $addition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Addition  $addition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Addition $addition)
    {
        //
    }
}

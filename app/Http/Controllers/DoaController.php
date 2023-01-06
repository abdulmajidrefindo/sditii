<?php

namespace App\Http\Controllers;

use App\Models\Doa;
use App\Http\Requests\StoreDoaRequest;
use App\Http\Requests\UpdateDoaRequest;

class DoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreDoaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDoaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doa  $doa
     * @return \Illuminate\Http\Response
     */
    public function show(Doa $doa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doa  $doa
     * @return \Illuminate\Http\Response
     */
    public function edit(Doa $doa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDoaRequest  $request
     * @param  \App\Models\Doa  $doa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDoaRequest $request, Doa $doa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doa  $doa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doa $doa)
    {
        //
    }
}

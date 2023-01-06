<?php

namespace App\Http\Controllers;

use App\Models\Hadist;
use App\Http\Requests\StoreHadistRequest;
use App\Http\Requests\UpdateHadistRequest;

class HadistController extends Controller
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
     * @param  \App\Http\Requests\StoreHadistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHadistRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hadist  $hadist
     * @return \Illuminate\Http\Response
     */
    public function show(Hadist $hadist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hadist  $hadist
     * @return \Illuminate\Http\Response
     */
    public function edit(Hadist $hadist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHadistRequest  $request
     * @param  \App\Models\Hadist  $hadist
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHadistRequest $request, Hadist $hadist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hadist  $hadist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hadist $hadist)
    {
        //
    }
}

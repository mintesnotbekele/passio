<?php

namespace App\Http\Controllers;

use App\Models\MissingItem;
use Illuminate\Http\Request;

class MissingItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('missingitems.index');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MissingItem  $missingItem
     * @return \Illuminate\Http\Response
     */
    public function show(MissingItem $missingItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MissingItem  $missingItem
     * @return \Illuminate\Http\Response
     */
    public function edit(MissingItem $missingItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MissingItem  $missingItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MissingItem $missingItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MissingItem  $missingItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(MissingItem $missingItem)
    {
        //
    }
}

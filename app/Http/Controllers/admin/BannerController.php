<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showBannerEdit()
    {
        return view('/admin/banner_edit');
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
     * @param  \App\Models\Bnner  $bnner
     * @return \Illuminate\Http\Response
     */
    public function show(Bnner $bnner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bnner  $bnner
     * @return \Illuminate\Http\Response
     */
    public function edit(Bnner $bnner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bnner  $bnner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bnner $bnner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bnner  $bnner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bnner $bnner)
    {
        //
    }
}

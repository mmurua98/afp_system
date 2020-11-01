<?php

namespace App\Http\Controllers;

use App\Models\TiposIva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TiposIvaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('haveaccess', 'iva.index');
        $tiposIva = TiposIva::all();
        return view('admin.iva', compact('tiposIva'));
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
        Gate::authorize('haveaccess', 'iva.store');
        TiposIva::create($request->all());
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TiposIva  $tiposIva
     * @return \Illuminate\Http\Response
     */
    public function show(TiposIva $tiposIva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TiposIva  $tiposIva
     * @return \Illuminate\Http\Response
     */
    public function edit(TiposIva $tiposIva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TiposIva  $tiposIva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Gate::authorize('haveaccess', 'iva.update');
        $tiposIva = TiposIva::findOrFail($request->id);
        $tiposIva->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TiposIva  $tiposIva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Gate::authorize('haveaccess', 'iva.destroy');
        $tiposIva = TiposIva::findOrFail($request->id);
        $tiposIva->delete($request->all());
        return back();
    }
}

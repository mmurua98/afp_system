<?php

namespace App\Http\Controllers;

use App\Models\RequireEmployee;
use Illuminate\Http\Request;

class RequireEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requireEmployees = RequireEmployee::all();
        return view('admin.require', compact('requireEmployees'));
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
        RequireEmployee::create($request->all());
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequireEmployee  $requireEmployee
     * @return \Illuminate\Http\Response
     */
    public function show(RequireEmployee $requireEmployee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequireEmployee  $requireEmployee
     * @return \Illuminate\Http\Response
     */
    public function edit(RequireEmployee $requireEmployee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequireEmployee  $requireEmployee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $requireEmployees = RequireEmployee::findOrFail($request->id);
        $requireEmployees->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequireEmployee  $requireEmployee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $requireEmployees = RequireEmployee::findOrFail($request->id);
        $requireEmployees->delete($request->all());
        return back();
    }
}

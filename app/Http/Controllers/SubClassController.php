<?php

namespace App\Http\Controllers;

use App\Models\SubClass;
use Illuminate\Http\Request;

class SubClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subkelas = SubClass::all();  
        return view("klasifikasi.subkelas", compact("subkelas"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SubClass $subClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubClass $subClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubClass $subClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubClass $subClass)
    {
        //
    }
}

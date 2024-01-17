<?php

namespace App\Http\Controllers;

use App\Models\Space;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $spaces = Space::select("id as valor","proceso as label")
        ->orderby('id','desc')
        ->Get();
        return $spaces;
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
        $spaces = Space::Where('status','1003')->get();
        foreach($spaces as $item){
            $item->status = 1002;
            $item->save();
        }
        //if(!$space instanceof Space){
            $space = new Space;
            $space->proceso = 'Proceso ' . date('d/m/Y H:i:s');
            $space->status = 1003;
            $space->save();
        //}

        return $space;
    }

    /**
     * Display the specified resource.
     */
    public function show(Space $space)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Space $space)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Space $space)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Space $space)
    {
        //
    }
}

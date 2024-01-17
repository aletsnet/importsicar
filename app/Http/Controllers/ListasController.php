<?php

namespace App\Http\Controllers;

use App\Models\Listas;
use App\Models\Space;
use Illuminate\Http\Request;

class ListasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($space, $search)
    {
        //
        \Log::info("index");
        $search = $search == '@' ? "" : $search;
        //$space = $request->departamentos;

        $list = Listas::where('space',$space)
            ->where(function($query) use($search){
                if($search != ""){
                    $query->where('color','like','%'.$search.'%');
                    $query->OrWhere('lote','like','%'.$search.'%');
                    $query->OrWhere('paquete','like','%'.$search.'%');
                    $query->OrWhere('kilos','like','%'.$search.'%');
                    $query->OrWhere('costo','like','%'.$search.'%');
                }
            })
            ->get();
        
        
        return $list;
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $row = Listas::where('id', $id)->first();
        if($row instanceof Listas){
            $row->delete();
        }

    }

    public function savefile($space, Request $request){
        $datos = $request->data;

        foreach($datos as $item){
            $row = new Listas;
            if($item['A'] != null){
                $row->color = $item['A'];
                $row->lote= $item['B'];
                $row->paquete= $item['C'];
                $row->kilos= $item['D'];
                $row->costo= $item['E'];
                $row->presio= $item['F'];
                $row->numero= $item['G'];
                $row->repetido= $item['H'];
                $row->space = $space;
                $row->status = 1002;
                $row->save();
            }
        }

        return ['status' => 'ok'];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function printer($space, $id)
    {
        $row = Listas::where('id', $id)->first();
        if(!$row instanceof Listas){
            redirect()->route('home');
        }
        $param = [
            'rows' => [$row]
        ];

        return view('etiqueta', $param);
    }

    public function printerAll($space, Request $request)
    {
        $rows = Listas::where('space', $space)->get();
        
        $param = [
            'rows' => $rows
        ];

        return view('etiqueta', $param);
    }
}

<?php

namespace App\Http\Controllers\Viaticos;

use Illuminate\Http\Request;

use App\Models\Area;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AreasController extends ViaticosController
{

    /**
     * [__construct description]
     */
    public function __construct()
    {
        parent::__construct();
        view()->share('section', 'areas');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        //
        $areas = Area::get();
        return view('viaticos.areas.index', ['areas' => $areas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        //
        $area = new Area();

        return view('viaticos.areas.create', ['area' => $area]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request)
    {
        $data = [
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion')
        ];

        $area = Area::create($data);

        if($area){
            return redirect( 'viaticos/areas' )
                ->with('success', 'Area creada.');
        }else{
            return redirect( 'viaticos/areas' )
                ->with('error', 'Error al crear area.');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getView($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        //
        $area = Area::find($id);

        return view('viaticos.areas.create', ['area' => $area]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postEdit(Request $request)
    {
        //
        $area = Area::find($request->id);

        $area->nombre = $request->nombre;
        $area->descripcion = $request->descripcion;

        if($area->update()){
            return redirect( 'viaticos/areas' )
                ->with('success', 'Area creada.');
        }else{
            return redirect( 'viaticos/areas' )
                ->with('error', 'Error al crear area.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDelete($id)
    {
        //
        $area = Area::find($id);

        if($area->delete($id)){
            return redirect( 'viaticos/areas' )
                ->with('success', 'Area eliminada.');
        }else{
            return redirect( 'viaticos/areas' )
                ->with('error', 'Error al eliminar area.');
        }
    }
}

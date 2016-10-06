<?php

namespace App\Http\Controllers\Viaticos;

use Illuminate\Http\Request;

use App\Models\Solicitud;
use App\Models\Cuenta;
use App\Models\Area;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SolicitudesController extends Controller
{

    /**
     * [__construct description]
     */
    public function __construct()
    {
        parent::__construct();
        view()->share('section', 'solicitudes');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        //
        $solicitudes = Solicitud::get();

        return view('viaticos.solicitudes.index', ['solicitudes' => $solicitudes]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        //
        $solicitud = new Solicitud();
        $cuentas = Cuenta::get();
        $areas = Area::get();

        return view('viaticos.solicitudes.create', 
            ['solicitud' => $solicitud, 'cuentas' => $cuentas, 'areas' => $areas]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request)
    {
        //
        dd($request);

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
        return view('viaticos.solicitudes.view');

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
        return view('viaticos.solicitudes.edit');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postEdit(Request $request, $id)
    {
        //
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
    }
}

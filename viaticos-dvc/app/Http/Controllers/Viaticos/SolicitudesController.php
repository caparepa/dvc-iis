<?php

namespace App\Http\Controllers\Viaticos;

use Illuminate\Http\Request;

use App\Models\Solicitud;
use App\Models\Cuenta;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SolicitudesController extends ViaticosController
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
        
        return view('viaticos.solicitudes.create', 
            ['solicitud' => $solicitud, 'cuentas' => $cuentas]);

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
        $usuario = Auth::user();

        $data = [
            "asunto" => $request->asunto,
            "area" => $request->area,
            "beneficiario" => $request->beneficiario,
            "cedula" => $request->cedula,
            "rif" => $request->rif == '' ? null : $request->rif,
            "fecha_solicitud" => $request->fecha_solicitud,
            "descripcion" => $request->descripcion,
            "monto" => $request->monto,
            "id_cuenta" => $request->id_cuenta,
            "id_usuario" => $usuario->id
        ];

        $solicitud = Solicitud::create($data);

        if( $solicitud ) {
            return redirect( 'viaticos/solicitudes' )
                ->with('success', 'Solicitud creada.');
        }
        else {
            return redirect( 'viaticos/solicitudes' )
                ->with('Error', 'Ha ocurrido un error.');
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
        $solicitud = Solicitud::find($id);
        return view('viaticos.solicitudes.view', ['solicitud' => $solicitud]);

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

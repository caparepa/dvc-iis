<?php

namespace App\Http\Controllers\Viaticos;

use Illuminate\Http\Request;

use App\Models\Usuario;
use App\Models\Solicitud;
use App\Models\Cuenta;
use App\Models\RazonSocial;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SolicitudesController extends ViaticosController
{

    /**
     * [__construct description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2016-11-12
     */
    public function __construct()
    {
        parent::__construct();
        view()->share('section', 'solicitudes');
    }

    /**
     * [getIndex description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2016-11-12
     * @return [type]     [description]
     */
    public function getIndex()
    {
        //
        $solicitudes = Solicitud::orderBy('updated_at', 'DESC')->get();
        
        $user = Auth::user();
        $revisor = in_array($user->rol, [Usuario::ROL_DIRECCION, Usuario::ROL_ADMINISTRACION]) ? true : false;

        return view('viaticos.solicitudes.index', ['solicitudes' => $solicitudes, 'type' => 'index_all', 'revisor' => $revisor]);


    }

    /**
     * [getListadoSolicitudesUsuario description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2016-11-12
     * @return [type]     [description]
     */
    public function getListadoSolicitudesUsuario(){
        
        $user = Auth::user();
        $solicitudes = Solicitud::where('id_usuario', $user->id)->get();
        $revisor = in_array($user->rol, [Usuario::ROL_DIRECCION, Usuario::ROL_ADMINISTRACION]) ? true : false;
        
        return view('viaticos.solicitudes.index', ['solicitudes' => $solicitudes, 'type' => 'index_user']);
    }

    /**
     * [getCreate description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2016-11-12
     * @return [type]     [description]
     */
    public function getCreate()
    {
        $solicitud = new Solicitud();
        $cuentas = Cuenta::get();

        return view('viaticos.solicitudes.create', 
            ['solicitud' => $solicitud, 'cuentas' => $cuentas]);

    }

    /**
     * [postCreate description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2016-11-12
     * @param  Request    $request [description]
     * @return [type]              [description]
     */
    public function postCreate(Request $request)
    {
        //
        $usuario = Auth::user();
        $fecha = new \DateTime($request->fecha_solicitud); //creo un objeto de tipo fecha
        
        $data = [
            "asunto" => $request->asunto,
            "area" => $request->area,
            "beneficiario" => $request->beneficiario, //razon social
            "cedula_rif" => $request->cedula_rif == '' ? null : $request->cedula_rif,
            "fecha_solicitud" => $fecha->format('Y-m-d H:i:s'),
            "descripcion" => $request->descripcion,
            "monto" => (float)$request->monto, //parseo el monto a float porque a sqlserver no le gustan los strings
            "status" => Solicitud::STATUS_PENDING,
            "id_cuenta" => $request->id_cuenta,
            "id_usuario" => $usuario->id
        ];

        $listab_ = RazonSocial::where('nombre', $request->beneficiario)->get();
        if(count($listab_) == 0){
            $datar_ = ['nombre' => $request->beneficiario];
            $razon_social = RazonSocial::create($datar_);
        }

        $solicitud = Solicitud::create($data);
        
        if( $solicitud ) {
            return redirect( 'viaticos/solicitudes' )
                ->with('success', 'Solicitud creada.');
        } else {
            return redirect( 'viaticos/solicitudes' )
                ->with('Error', 'Ha ocurrido un error.');
        }

    }

    /**
     * [getView description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2016-11-12
     * @param  [type]     $id [description]
     * @return [type]         [description]
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
        $solicitud = Solicitud::find($id);
        $cuentas = Cuenta::get();
        
        return view('viaticos.solicitudes.edit', 
            ['solicitud' => $solicitud, 'cuentas' => $cuentas]);

    }

    /**
     * [postEdit description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2016-11-12
     * @param  Request    $request [description]
     * @return [type]              [description]
     */
    public function postEdit(Request $request)
    {

        $solicitud = Solicitud::find($request->id);
        $fecha = new \DateTime($request->fecha_solicitud); //creo un objeto de tipo fecha
        
        $solicitud->asunto = $request->asunto;
        $solicitud->area = $request->area;
        $solicitud->beneficiario = $request->beneficiario;
        $solicitud->cedula_rif = $request->cedula_rif == '' ? null : $request->cedula_rif;
        $solicitud->fecha_solicitud = $fecha->format('Y-m-d H:i:s');
        $solicitud->descripcion = $request->descripcion;
        $solicitud->monto = (float)$request->monto;
        $solicitud->id_cuenta = $request->id_cuenta;
        
        $listab_ = RazonSocial::where('nombre', $request->beneficiario)->get();
        
        if(count($listab_) == 0){
            $datar_ = ['nombre' => $request->beneficiario];
            $razon_social = RazonSocial::create($datar_);
        }

        $solicitud = Solicitud::create($data);
        
        if( $solicitud ) {
            return redirect( 'viaticos/solicitudes' )
                ->with('success', 'Solicitud editada.');
        } else {
            return redirect( 'viaticos/solicitudes' )
                ->with('Error', 'Ha ocurrido un error.');
        }
    }

    /**
     * [getDelete description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2016-11-12
     * @param  [type]     $id [description]
     * @return [type]         [description]
     */
    public function getDelete($id)
    {
        //
    }

    /**
     * [getListadoRazonSocial description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2016-11-12
     * @param  Request    $request [description]
     * @return [type]              [description]
     */
    public function getListadoRazonSocial(Request $request)
    {
        
        $query = $request->term;
        $listado = RazonSocial::getListadoRazonSocialByString($query);

        $result = [];
        
        foreach ($listado as $razon) {
            $result[] = $razon->nombre; 
        }
        
        return response()->json([
            'listado' => $result
        ]);
    }

    /**
     * [getValidarRendicionPendiente description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2016-11-12
     * @return [type]     [description]
     */
    public function getValidarRendicionPendiente()
    {

        $usuario = Auth::user();
        $result = Solicitud::validarRendicionCuentaPendiente($usuario->id);
        $shit = Usuario::getUsuariosSolicitudesPendientes();
        \Log::info($shit);

        return response()->json([
            'result' => $result,
            'someothershit' => $shit 
        ]);

    }

    /**
     * [getCambiarStatusSolicitud description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2016-11-12
     * @param  [type]     $id_solicitud [description]
     * @param  [type]     $status       [description]
     * @return [type]                   [description]
     */
    public function getCambiarStatusSolicitud($id_solicitud, $status)
    {

        $solicitud = Solicitud::find($id_solicitud);
        $solicitud->status = $status;
        
        if($solicitud->update()){
            $result = Solicitud::updateHistoricoSolicitudes($id_solicitud, Auth::user()->id, $status);
        }

        if($status == Solicitud::STATUS_APPROVED){
            return redirect( 'viaticos/solicitudes' )
                ->with('success', 'Solicitud aprobada.');
        }else if($status == Solicitud::STATUS_DENIED){
            return redirect( 'viaticos/solicitudes' )
                ->with('error', 'Solicitud denegada.');
        }
    }

    public function getValidarFechaTope(Request $request)
    {

        $id_usuario = $request->id;
        $fecha_solicitud = $request->fecha_solicitud;
        
        $fecha_tope = Solicitud::validarFechaTopeSolicitudes($id_usuario);

        dd($fecha_tope);

        //WIP! Terminar!!!

        return response()->json([
            'result' => $result
        ]);
    }
}

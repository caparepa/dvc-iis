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
     */
    public function __construct()
    {
        parent::__construct();
        view()->share('section', 'solicitudes');
    }

    /**
     * Listado de solicitudes (meh... indice regular)
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        //
        $solicitudes = Solicitud::get();
        
        $user = Auth::user();
        $revisor = in_array($user->rol, [Usuario::ROL_DIRECCION, Usuario::ROL_ADMINISTRACION]) ? true : false;

        return view('viaticos.solicitudes.index', ['solicitudes' => $solicitudes, 'type' => 'index_all', 'revisor' => $revisor]);


    }

    /**
     * Listado de solicitudes dado un usuario
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getListadoSolicitudesUsuario(){
        
        $user = Auth::user();
        $solicitudes = Solicitud::where('id_usuario', $user->id)->get();
        $revisor = in_array($user->rol, [Usuario::ROL_DIRECCION, Usuario::ROL_ADMINISTRACION]) ? true : false;
        
        return view('viaticos.solicitudes.index', ['solicitudes' => $solicitudes, 'type' => 'index_user']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
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
        $fecha = new \DateTime($request->fecha_solicitud); //creo un objeto de tipo fecha
        
        $data = [
            "asunto" => $request->asunto,
            "area" => $request->area,
            "beneficiario" => $request->beneficiario, //razon social
            "cedula_rif" => $request->cedula_rif == '' ? null : $request->cedula_rif,
            "fecha_solicitud" => $fecha->format('Y-m-d H:i:s'),
            "descripcion" => $request->descripcion,
            "monto" => (float)$request->monto, //parseo el monto a float porque a sqlserver no le gustan los strings
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


    public function getListadoRazonSocial(Request $request){
        
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

    public function getValidarRendicionPendiente(){

        $usuario = Auth::user();
        $result = Solicitud::validarRendicionCuentaPendiente($usuario->id);

        return response()->json([
            'result' => $result
        ]);

    }

    public function getCambiarStatusSolicitud($id_solicitud, $status){

        $solicitud = Solicitud::find($id);
        $solicitud->status = $status;
        $solicitud->update();

        if($status == Solicitd::STATUS_APPROVED){
            return redirect( 'viaticos/solicitudes' )
                ->with('success', 'Solicitud aprobada.');
        }else if($status == Solicitd::STATUS_DENIED){
            return redirect( 'viaticos/solicitudes' )
                ->with('error', 'Solicitud denegada.');
        }
    }
}

<?php

namespace App\Http\Controllers\Viaticos;

use App\Models\RendicionCuenta;
use App\Models\Gasto;
use App\Models\Usuario;
use App\Models\Solicitud;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RendicionCuentasController extends Controller
{

    /**
     * [__construct description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2017-01-22
     */
    public function __construct()
    {
        parent::__construct();
        view()->share('section', 'rendiciones');
    }

    /**
     * [getIndex description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2017-01-22
     * @return [type]     [description]
     */
    public function getIndex()
    {
        //
    }

    /**
     * [getRendicionesPendientesUsuario description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2017-01-22
     * @return [type]     [description]
     */
    public function getRendicionesPendientesUsuario(){
        
        /*$user = Auth::user();
        $solicitudes = Solicitud::where('id_usuario', $user->id)->get();
        $revisor = in_array($user->rol, [Usuario::ROL_DIRECCION, Usuario::ROL_ADMINISTRACION]) ? true : false;
        
        return view('viaticos.solicitudes.index', ['solicitudes' => $solicitudes, 'type' => 'index_user']);*/
    }

    /**
     * [getCreate description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2017-01-22
     * @return [type]     [description]
     */
    public function getCreate()
    {
        //
    }

    /**
     * [postCreate description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2017-01-22
     * @param  Request    $request [description]
     * @return [type]              [description]
     */
    public function postCreate(Request $request)
    {
        //
    }

    /**
     * [getView description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2017-01-22
     * @param  [type]     $id [description]
     * @return [type]         [description]
     */
    public function getView($id)
    {
        //
    }

    /**
     * [getEdit description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2017-01-22
     * @param  [type]     $id [description]
     * @return [type]         [description]
     */
    public function getEdit($id)
    {
        //
    }

    /**
     * [postEdit description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2017-01-22
     * @param  Request    $request [description]
     * @return [type]              [description]
     */
    public function postEdit(Request $request)
    {
        //
    }

    /**
     * [getDelete description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2017-01-22
     * @param  [type]     $id [description]
     * @return [type]         [description]
     */
    public function getDelete($id)
    {
        //
    }

    /**
     * [getAprobarRendicion description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2017-01-22
     * @param  [type]     $id [description]
     * @return [type]         [description]
     */
    public function getAprobarRendicion($id){

    }

    /**
     * [postRechazarRendicion description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2017-01-22
     * @param  Request    $request [description]
     * @return [type]              [description]
     */
    public function postRechazarRendicion(Request $request){

    }

}

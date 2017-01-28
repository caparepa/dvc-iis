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
     * Corresponde a lsa rendiciones de cuentas pendientes que puede ver el usuario administrador
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2017-01-22
     * @return [type]     [description]
     */
    public function getIndex()
    {
        $rendiciones = RendicionCuenta::get();
        
        $user = Auth::user();
        $revisor = in_array($user->rol, [Usuario::ROL_DIRECCION, Usuario::ROL_ADMINISTRACION]) ? true : false;

        return view('viaticos.rendiciones.index', ['rendiciones' => $rendiciones, 'type' => 'index_all', 'revisor' => $revisor]);
    }

    /**
     * rendiciones (pendientes) de un usuario solicitante
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2017-01-22
     * @return [type]     [description]
     */
    public function getRendicionesUsuario()
    {
        
        $user = Auth::user();
        $rendiciones = RendicionCuenta::where('id_usuario', $user->id)->get();
        $revisor = in_array($user->rol, [Usuario::ROL_DIRECCION, Usuario::ROL_ADMINISTRACION]) ? true : false;
        
        return view('viaticos.rendiciones.index', ['rendiciones' => $rendiciones, 'type' => 'index_user']);
    }

    /**
     * Crear rendicion (que no es mas que agarrar la data de la solicitud culminada y con estatus de rendicion pendiente)
     * (y un formulario)
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2017-01-22
     * @return [type]     [description]
     */
    public function getCreate($id_solicitud)
    {
        //
        $rendicion = new RendicionCuenta();
        $solicitud = Solicitud::get();

        return view('viaticos.rendiciones.create', 
            ['rendicion' => $rendicion, 'solicitud' => $solicitud]);
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
     * Guarda temporalmente la data de la rendicion de cuentas que se esta realizando
     * Se toma tanto para el create como para el edit
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2017-01-28
     * @param  Request    $request [description]
     * @return [type]              [description]
     */
    public function getSaveDataRendicionCuenta(Request $request)
    {

    }

    /**
     * Ver detalle de la rendición de cuentas
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2017-01-22
     * @param  [type]     $id [description]
     * @return [type]         [description]
     */
    public function getView($id)
    {
        //
        $rendicion = RendicionCuenta::find($id);
        return view('viaticos.rendiciones.view', ['rendicion' => $rendicion]);

    }

    /**
     * Este metodo obtiene la informacion a editar del borrador de la rendicion de cuentas
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
     * Envia la rendición de cuentas creada o editada...
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
     * Elimina rendición de cuenta, evidentemente
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
     * Este metodo cambia el status de la rendicion
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2017-01-22
     * @param  [type]     $id [description]
     * @return [type]         [description]
     */
    public function getCambiarStatusRendicion($id, $status, $descripcion){

        $rendicion = RendicionCuenta::find($id);



    }

}

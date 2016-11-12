<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Solicitud extends Model
{
    //
    use SoftDeletes;

	const STATUS_PENDING = 'pendiente';
	const STATUS_APPROVED = 'aprobada';
	const STATUS_DENIED = 'rechazada';
    const STATUS_ACCOUNT = 'rendicion'; //este estado correspondo a una solicitud aprobada con fecha limite pasada
	
    protected $table = 'solicitudes';

    protected $appends = ['fechaViatico', 'fechaCreacion'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = [
    	'asunto',
    	'area',
    	'beneficiario',
    	'cedula_rif',
    	'fecha_solicitud',
    	'descripcion',
    	'monto',
    	'id_usuario',
    	'id_cuenta'
    ];

    public $timestamps = true;

    /**
     * [usuario description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2016-11-12
     * @return [type]     [description]
     */
    public function usuario()
    {
    	return $this->belongsTo('App\Models\Usuario', 'id_usuario');
    }

    /**
     * [historicoSolicitudes description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2016-11-12
     * @return [type]     [description]
     */
    public function historicoSolicitudes(){
    	return $this->belongsToMany('App\Model\Usuario', 'historico_solicitudes', 'id_solicitud', 'id_revisor')
    				->withPivot('fecha', 'status');
    }

    /**
     * [cuenta description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2016-11-12
     * @return [type]     [description]
     */
    public function cuenta()
    {
    	return $this->belongsTo('App\Models\Cuenta', 'id_cuenta');
    }

    /**
     * [getFechaViaticoAttribute description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2016-11-12
     * @return [type]     [description]
     */
    public function getFechaViaticoAttribute(){
        $fecha = new \DateTime($this->fecha_solicitud);
        $result = $fecha->format('d-m-Y');
        return $result;
    }

    /**
     * [getAttributeFechaCreacion description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2016-11-12
     * @return [type]     [description]
     */
    public function getFechaCreacionAttribute(){
        $fecha = new \DateTime($this->created_at);
        $result = $fecha->format('d-m-Y');
        return $result;
    }

    /**
     * Funciones de validacion, etc
     */
    
    /**
     * Valida si el usuario tiene o no rendiciones de cuentas pendientes
     * El id de usuario que se pasa es la del solicitante
     * @param  [type] $id_usuario [description]
     * @return [type]             [description]
     */
    public static function validarRendicionCuentaPendiente($id_usuario)
    {

        $solicitudes = Solicitud::with('usuario')->where('id_usuario', $id_usuario)->get();
        $count = 0;

        foreach ($solicitudes as $solicitud) {
            $count += $solicitud->status == Solicitud::STATUS_ACCOUNT ? 1 : 0;
        }
        
        return $count > 0 ? true : false; //true -> rendiciones de cuentas pendientes

    }

}

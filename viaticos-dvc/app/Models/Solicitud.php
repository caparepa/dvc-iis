<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Solicitud extends Model
{
    //
    use SoftDeletes;

	const STATUS_PENDING = 'pendiente'; //solicitud de viatico pendiente por revision
	const STATUS_APPROVED = 'aprobada'; //solicitud de viatico aprobara
	const STATUS_DENIED = 'rechazada'; //solicitud de viatico rechazada
    const STATUS_ACCOUNT = 'rendicion'; //este estado correspondo a una solicitud aprobada con fecha limite pasada
	
    protected $table = 'solicitudes';

    protected $appends = ['fechaViatico', 'fechaCreacion', 'statusSolicitud'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = [
    	'asunto',
    	'area',
    	'beneficiario',
    	'cedula_rif',
    	'fecha_solicitud',
    	'descripcion',
        'monto',
    	'status',
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
     * [historico_solicitudes description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2016-11-12
     * @return [type]     [description]
     */
    public function historico_solicitudes()
    {
    	return $this->belongsToMany('App\Models\Usuario', 'historico_solicitudes', 'id_solicitud', 'id_revisor')
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
    public function getFechaViaticoAttribute()
    {
        $fecha = new \DateTime($this->fecha_solicitud);
        $result = $fecha->format('d-m-Y');
        return $result;
    }

    /**
     * [getStatusSolicitudAttribute description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2017-01-29
     * @return [type]     [description]
     */
    public function getStatusSolicitudAttribute()
    {
        switch ($this->status) {
            case self::STATUS_PENDING:
                return 'Pendiente';
            case self::STATUS_APPROVED:
                return 'Aprobada';
            case self::STATUS_DENIED:
                return 'Negada';
            case self::STATUS_ACCOUNT:
                return 'Rendición pendiente';
            default:
                return 'N/A';
        }
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

    /**
     * [updateHistoricoSolicitudes description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2016-11-12
     * @param  [type]     $id_solicitud     [description]
     * @param  [type]     $id_revisor       [description]
     * @param  [type]     $status_solicitud [description]
     * @return [type]                       [description]
     */
    public static function updateHistoricoSolicitudes($id_solicitud, $id_revisor, $status_solicitud)
    {
        $solicitud = self::find($id_solicitud);
        $now = new \DateTime();
        $fecha = $now->format('Y-m-d H:i:s');

        $result = $solicitud->historico_solicitudes()->attach($id_revisor, ['fecha' => $fecha, 'status' => $status_solicitud]);   

        return $result;
    }

}

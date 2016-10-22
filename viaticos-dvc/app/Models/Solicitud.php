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
	
    protected $table = 'solicitudes';

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

    public function usuario()
    {
    	return $this->belongsTo('App\Models\User', 'id_usuario');
    }

    public function historicoSolicitudes(){
    	return $this->belongsToMany('App\Model\User', 'historico_solicitudes', 'id_solicitud', 'id_revisor')
    				->withPivot('fecha', 'status');
    }

    /*public function area()
    {
    	return $this->belongsTo('App\Models\Area', 'id_area');
    }*/

    public function cuenta()
    {
    	return $this->belongsTo('App\Models\Cuenta', 'id_cuenta');
    }

    /**
     * Funciones de validacion, etc
     */
    
    /**
     * Valida si el usuario tiene o no rendiciones de cuentas pendientes
     * @param  [type] $id_usuario [description]
     * @return [type]             [description]
     */
    public static function validarRendicionCuentaPendiente($id_usuario){

    }

}

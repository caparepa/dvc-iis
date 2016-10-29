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
    	return $this->belongsTo('App\Models\Usuario', 'id_usuario');
    }

    public function historicoSolicitudes(){
    	return $this->belongsToMany('App\Model\Usuario', 'historico_solicitudes', 'id_solicitud', 'id_revisor')
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RendicionCuenta extends Model
{
    //
	use SoftDeletes;

    protected $table = 'rendicion_cuentas';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = [
    	'monto_total',
    	'status'
    ];

    public $timestamps = true;

    /**
     * Relacion con Gasto
     * @return [type] [description]
     */
    public function gastos()
    {
    	return $this->hasMany('App\Models\Gasto', 'id_rendicion');
    }

    /**
     * Relacion con solicitur
     * @return [type] [description]
     */
    public function solicitud()
    {
    	return $this->belongsTo('App\Models\Solicitud', 'id_solicitud');
    }

    /**
     * Relacion con usuario revisor
     * @return [type] [description]
     */
    public function revisor()
    {
    	return $this->belongsTo('App\Models\Usuario', 'id_revisor');
    }

    /**	
     * Relacion con usuario solicitante
     * @return [type] [description]
     */
    public function solicitante()
    {
    	return $this->belongsTo('App\Models\Usuario', 'id_solicitante')
    }
}

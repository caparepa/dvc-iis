<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RendicionCuenta extends Model
{
    //
	use SoftDeletes;

    const STATUS_APPROVED = 'aprobada';
    const STATUS_DENIED = 'negada';
    const STATUS_PENDIENTE = 'pendiente';

    protected $table = 'rendicion_cuentas';

    protected $appends = ['fechaRevision', 'statusRendicion'];

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
    	return $this->belongsTo('App\Models\Usuario', 'id_solicitante');
    }

    /**
     * [getFechaRevisionAttribute description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2017-01-29
     * @return [type]     [description]
     */
    public static function getFechaRevisionAttribute(){
        $fecha = new \DateTime($this->updated_at);
        $result = $fecha->format('d-m-Y');
        return $result;
    }

    /**
     * [getStatusRendicionAttribute description]
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2017-01-29
     * @return [type]     [description]
     */
    public static function getStatusRendicionAttribute() {
        switch ($this->status) {
            case self::STATUS_PENDING:
                return 'Pendiente de Revisión';
            case self::STATUS_APPROVED:
                return 'Aprobada';
            case self::STATUS_DENIED:
                return 'Negada';
            default:
                return 'N/A';
        }
    }
}

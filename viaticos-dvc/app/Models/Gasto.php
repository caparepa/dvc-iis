<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    //no me acuerdo para que servia este modelo...
    protected $table = 'gastos';

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'fecha',
    	'nombre_empresa', //este puede tener autocompletado... creo
        'descripcion',
    	'monto'
    ];

    public $timestamps = true;

    public function rendicion()
    {
    	return $this->BelongsTo('App\Models\RendicionCuenta', 'id_rendicion');
    }

    /**
     * Guarda los gastos correspondientes de la rendicion de cuentas
     * @author Christopher Serrano (serrano.cjm@gmail.com)
     * @date   2017-01-29
     * @param  [type]     $data [description]
     * @return [type]           [description]
     */
    public static function saveGastosPorRendicion($id_rendicion, $data){
        try {
            
        } catch (Exception $e) {
            
        }
    }
}

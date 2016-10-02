<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Cuenta extends Model
{
    //
    protected $table = 'cuentas';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = [
    	'nombre',
    	'codigo'
    ];

    public $timestamps = true;

    public function solicitudes()
    {
    	return $this->hasMany('App\Models\Solicitud', 'id_cuenta');
    }

}

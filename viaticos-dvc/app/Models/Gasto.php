<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    //
    protected $table = 'gastos';

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
    	'nombre',
    	'codigo'
    ];

    public $timestamps = true;

    public function solicitudes()
    {
    	return $this->BelongsTo('App\Models\RendicionCuenta', 'id_rendicion');
    }
}

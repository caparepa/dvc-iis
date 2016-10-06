<?php

namespace App\Models;

use Log;
use Exception;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'areas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        
    ];

    /**
     * [$dates description]
     * @var [type]
     */
    protected $dates = ['created_at', 'updated_at', 'deteled_at'];

    public $timestamps = true;

    /**
     * Relaciones
     */
    
    /**
     * Area a la que pertenece un usuario
     * @return [type] [description]
     */
    public function usuarios()
    {
        return $this->hasMany('App\Models\User', 'id_area');
    }

    public function solicitudes()
    {
        return $this->hasMany('App\Models\Solicitud', 'id_cuenta');
    }
}

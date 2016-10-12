<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RazonSocial extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'razon_social';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre'        
    ];

    /**
     * [$dates description]
     * @var [type]
     */
    protected $dates = ['created_at', 'updated_at', 'deteled_at'];

    public $timestamps = true;

    public static function getListadoRazonSocial(){
        $listado = \DB::table('razon_social')
                    ->select('nombre')
                    ->get();
        return $listado;
    }

    public static function getListadoRazonSocialByString($qstring)
    {
        $listado = \DB::table('razon_social')
                    ->select('nombre')
                    ->where('nombre', 'like', '%'.$qstring.'%')
                    ->get();
        
        return $listado;
    }
}

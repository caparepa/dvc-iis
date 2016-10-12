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
}

<?php

namespace App\Models;

use Log;
use Exception;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * Administrador del sistema (superadmin)
     */
    const ROL_ADMIN = 'admin';

    /**
     * Roles de usuarios
     */
    const ROL_DIRECCION = 'direccion';
    const ROL_ADMINISTRACION = 'administracion'
    const ROL_GERENCIA = 'gerente';
    const ROL_CAPTACION = 'captacion';
    const ROL_COMUNICACIONES = 'comunicaciones';
    const ROL_USUARIO = 'regular';

    /**
     * Posibles status de usuario
     */
    const STATUS_ACTIVE = 'active',
    const STATUS_INACTIVE = 'inactive';
    const STATUS_BLOCKED = 'blocked';
    const STATUS_SUSPENDED = 'suspended';
    const STATUS_DELETED = 'deleted';
    const STATUS_PENDING = 'pending';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'cedula',
        'rif',
        'telefono_hab',
        'telefono_cell',
        'email', 
        'password',
        'rol',
        'status',
        'id_area'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

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
     * Listado de solicitudes realizadas por un usuario
     * @return [type] [description]
     */
    public function solicitudes()
    {
        return $this->hasMany('App\Models\Solicitud', 'id_usuario');
    }

    /**
     * Historico de solicitudes y sus acciones por parte de los revisores
     * @return [type] [description]
     */
    public function historicoSolicitudes()
    {
        return $this->belongsToMany('App\Models\Solicitud', 'historico_solicitudes', 'id_usuario', 'id_solicitud')
                    ->withPivot('fecha', 'status');
    }

    /**
     * Area a la que pertenece un usuario
     * @return [type] [description]
     */
    public function area()
    {
        return $this->belongsTo('App\Models\Area', 'id_area');
    }

    /**
     * Validaciones de rol
     */
    
    public function isAdmin()
    {
        return $this->rol === self::ROL_ADMIN;
    }

    public function isDireccion()
    {
        return $this->rol === self::ROL_DIRECCION;
    }

    public function isAdministracion()
    {
        return $this->rol === self::ROL_ADMINISTRACION;
    }

    public function isGerencia()
    {
        return $this->rol === self::ROL_GERENCIA;
    }

    public function isCaptacion()
    {
        return $this->rol === self::ROL_CAPTACION;
    }
    
    public function isComunicaciones()
    {
        return $this->rol === self::ROL_COMUNICACIONES;
    }

    public function isUsuario()
    {
        return $this->rol === self::ROL_USUARIO;
    }

    /**
     * Validaciones de status
     */
    

    public function isActive(){
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isInactive(){
        return $this->status === self::STATUS_INACTIVE;
    }

    public function isBlocked(){
        return $this->status === self::STATUS_BLOCKED;
    }

    public function isSuspended(){
        return $this->status === self::STATUS_SUSPENDED;
    }
    
    public function isDeleted(){
        return $this->status === self::STATUS_DELETED;
    }
    
    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }
}

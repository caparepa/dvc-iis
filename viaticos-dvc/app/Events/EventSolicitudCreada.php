<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use App\Models\Usuario;
use App\Models\Solicitud;
use App\Models\RendicionCuenta;

class EventSolicitudCreada extends Event
{
	
    use SerializesModels;

    private $usuario;
    private $solicitud;
    private $rendicion;
	
    public function __construct(Usuario $usuario, Solicitud $solicitud, RendicionCuenta $rendicion)
    {
    	$this->usuario = $usuario;
    	$this->solicitud = $solicitud;
    	$this->rendicion = $rendicion;
    }

	/**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }

    public function getUsuario()
    {
    	return $this->usuario;
    }

    public function getSolicitud(){
    	return $this->solicitud;
    }

    public function getRendicion(){
    	return $this->rendicion;
    }
	
}

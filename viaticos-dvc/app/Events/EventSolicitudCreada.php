<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
/*use App\Models\Usuario;
use App\Models\Cliente;
use App\Models\Cita;
use App\Models\Vehiculo;*/

class EventSolicitudCreada extends Event
{
	
    use SerializesModels;
	
	const GUIA_ORIENTACION = 'guia'; //entra por defecto
	const CITA_CANCELADA = 'cancelada';
    const CITA_PENDIENTE = 'pendiente';    //se confirmo la guia de orientacion
	const CITA_CONFIRMADA = 'aceptada';    //
	const CITA_ENTREGADA = 'concluida';   //
    const CITA_SEGUNDA = 'segunda';
	
	private $usuario;
	private $cliente;
	private $vehiculo;
	private $cita;
	private $tipoCita;

	/**
     * Create a new event instance.
     * @param Usuario $usuario Usuario registrado (asesor)
     * @param Cliente $cliente Cliente al que se le asigna la cita
     * @param Vehiculo $vehiculo Vehiculo asociado a la venta y cita/guia de orientacion
	 * @param Cita $cita Cita en la cual se realizará la entrega del vehículo
	 * @param string $tipoCita indica el tipo de cita
     * @return void
     */
    public function __construct(Usuario $usuario, Cliente $cliente, \stdClass $vehiculo, \stdClass $cita, $tipoCita = 'guia')
    {
        $this->usuario = $usuario;
        $this->cliente = $cliente;
        $this->vehiculo = $vehiculo;
        $this->cita = $cita;
        $this->tipoCita = $tipoCita;
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

	public function getCliente()
	{
		return $this->cliente;
	}

	public function getVehiculo()
	{
		return $this->vehiculo;
	}

	public function getCita()
	{
		return $this->cita;
	}
	
	public function getTipoCita()
	{
		return $this->tipoCita;
	}

}

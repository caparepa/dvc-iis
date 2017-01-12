<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Events\EventSolicitudCreada;
use App\Models\Cita;

class ListenerSolicitudCreada
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UsuarioRegistrado  $event
     * @return void
     */
    public function handle(EventSolicitudCreada $event)
    {

		$asesor = $event->getUsuario();
		$cliente = $event->getCliente();
		$vehiculo = $event->getVehiculo();
		$cita = $event->getCita();
		$tipoCita = $event->getTipoCita();

		\Log::info('ListenerSolicitudCreada - Envio de emails');

		switch($tipoCita){
			case Cita::STATUS_GUIDE:
					Mail::send('emails.ce.guia_orientacion',[
						'cita' => $cita,
						'cliente' => $cliente,
						'vehiculo' => $vehiculo,
						'asesor' => $asesor],
						function($message) use ($cliente) {
							$message->to($cliente->email, $cliente->nombre);
							$message->subject('¡Felicitaciones por tu nuevo vehículo! Comienza a sentir la Experiencia Ford...');
						}
					);
					\Log::info('Guia de Orientacion: envio de email.');
					\Log::info('Email asesor: '.$asesor->email.' - Email cliente (destinatario): '.$cliente->email);
					//Validacion de errores de envio
					if( count(Mail::failures()) > 0 ) {
						$lista_errores = '';
						foreach(Mail::failures as $email) {
							$lista_errores = ' - ' . $email . PHP_EOL;
						}						
						\Log::error('Guia de orientacion: error de envio a los siguientes destinatarios - ' . PHP_EOL . $lista_errores);
					} else {
					    \Log::info('Guia de orientacion: no hubo errores de envio.');
					}
				break;
			case Cita::STATUS_PENDING:
					Mail::send('emails.ce.cita_pendiente',[
						'cliente' => $cliente,
						'vehiculo' => $vehiculo,
						'asesor' => $asesor,
            'cita' => $cita],
						function($message) use ($asesor) {
							$message->to($asesor->email, $asesor->fullName);
							$message->subject('Guía de Orientación - Tecnologías Seleccionadas');
						}
					);
				break;
			case Cita::STATUS_ACCEPTED:
					Mail::send('emails.ce.cita_confirmada',[
						'cliente' => $cliente,
						'asesor' => $asesor,
						'vehiculo' => $vehiculo,
						'asesor' => $asesor,
						'cita' => $cita],
						function($message) use ($cliente, $cita) {
							$message->to($cliente->email, $cliente->nombre);
							$message->subject('¡Felicitaciones por tu nuevo vehículo! Comienza a sentir la Experiencia Ford...');
							if($cita->ficha_tecnologias != null && file_exists(public_path().$cita->ficha_tecnologias)){
								$message->attach(public_path().$cita->ficha_tecnologias);
							}
						}
					);
				break;
			case Cita::STATUS_POST:
					Mail::send('emails.ce.segunda_cita',[
						'cliente' => $cliente,
						'asesor' => $asesor,
						'vehiculo' => $vehiculo,
						'asesor' => $asesor,
						'cita' => $cita],
						function($message) use ($cliente) {
							$message->to($cliente->email, $cliente->nombre);
							$message->subject('¡Felicitaciones por tu nuevo vehículo! Comienza a sentir la Experiencia Ford...');
						}
					);
				break;
			case Cita::STATUS_CANCELLED:
					\Log::info('ListenerSolicitudCreada -> STATUS_CANCELLED');
				break;
			default:
					\Log::info('ListenerSolicitudCreada -> default_action');
		}

    }
}

<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Events\EventSolicitudCreada;
use App\Models\Usuario;
use App\Models\Solicitud;
use App\Models\RendicionCuenta;

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

		$usuario = $event->getUsuario();
		$solicitud = $event->getSolicitud();
		$rendicion = $event->getRendicion();

		\Log::info('ListenerSolicitudCreada - Envio de emails');

		//se envia un mail a las personas de administración, y otro mail al solicitante
		switch ($solicitud->status) {
			case Solicitud::STATUS_PENDING:
				//se envia un mail al usuario al solicitante, y un mail al encargado
				Mail::send('emails.viaticos.solicitud_creada',['solicitud' => $solicitud, 'usuario' => $usuario],
					function($message) use ($usuario) {
						$message->to($usuario->email, $usuario->fullName);
						$message->subject('Se ha creado una nueva solicitud de viatico.');
					}
				);
				\Log::info('Crear solicitud: envio de email.');
				//Validacion de errores de envio
				if( count(Mail::failures()) > 0 ) {
					$lista_errores = '';
					foreach(Mail::failures as $email) {
						$lista_errores = ' - ' . $email . PHP_EOL;
					}						
					\Log::error('Solicitud creada: error de envio a los siguientes destinatarios - ' . PHP_EOL . $lista_errores);
				} else {
				    \Log::info('Solicitud creada: no hubo errores de envio.');
				}
				break;
			case Solicitud::STATUS_APPROVED:
				//mail para el solicitante
				Mail::send('emails.viaticos.solicitud_aprobada',['solicitud' => $solicitud, 'usuario' => $usuario],
					function($message) use ($usuario) {
						$message->to($usuario->email, $usuario->fullName);
						$message->subject('Su solicitud de viáticos ha sido aprobada.');
					}
				);
				\Log::info('Solicitud aprobada: envio de email.');
				//Validacion de errores de envio
				if( count(Mail::failures()) > 0 ) {
					$lista_errores = '';
					foreach(Mail::failures as $email) {
						$lista_errores = ' - ' . $email . PHP_EOL;
					}						
					\Log::error('Solicitud aprobada: error de envio a los siguientes destinatarios - ' . PHP_EOL . $lista_errores);
				} else {
				    \Log::info('Solicitud aprobada: no hubo errores de envio.');
				}
				break;
			case Solicitud::STATUS_DENIED:
				//mail para el solicitante
				Mail::send('emails.viaticos.solicitud_negada',['solicitud' => $solicitud, 'usuario' => $usuario],
					function($message) use ($usuario) {
						$message->to($usuario->email, $usuario->fullName);
						$message->subject('Su solicitud de viáticos ha sido negada.');
					}
				);
				\Log::info('Solicitud negada: envio de email.');
				//Validacion de errores de envio
				if( count(Mail::failures()) > 0 ) {
					$lista_errores = '';
					foreach(Mail::failures as $email) {
						$lista_errores = ' - ' . $email . PHP_EOL;
					}						
					\Log::error('Solicitud negada: error de envio a los siguientes destinatarios - ' . PHP_EOL . $lista_errores);
				} else {
				    \Log::info('Solicitud negada: no hubo errores de envio.');
				}
				break;
			case Solicitud::STATUS_ACCOUNT:
				//nothing here, welp
				break;
			default:
				//nothing else, welp
				break;
		}

    }
}

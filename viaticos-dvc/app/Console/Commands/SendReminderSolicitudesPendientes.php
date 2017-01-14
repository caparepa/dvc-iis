<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;

// use App\Models\Solicitud;
// use App\Models\Usuario;
// use App\Models\Cliente;
// use App\Models\Concesionario;
// use App\Models\Sala;
// use App\Models\VehiculoModelo;
// use App\Models\VehiculoVersion;
// use App\Models\Vehiculo;

use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Mail;

class SendReminderSolicitudesPendientes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:send-reminder-solicitudes-pendientes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envía por mail recordatorios de solicitudes pendientes por cerrar (rendicion de cuentas).';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /**** MAIL CITAS PROXIMAS ****/

        try{

            $usuarios_pendientes = [];
            $fecha_actual = new DateTime('now');

            //Primero se busca el listado de usuarios con rendiciones de cuentas pendientes
            $usuarios = Usuario::getUsuariosSolicitudesPendientes();

            //si alguno de los usuarios tiene rendiciones pendientes, se agrega al array nuevo
            foreach ($usuarios as $usuario) {
                
                //objeto generico para armar cada email a enviar
                $usuario_mail = new \stdClass();
                $usuario_mail->fullName = $usuario->fullName;
                $usuario_mail->email = $usuario->email;
                $usuario_mail->rendicionesPendientes = 0;

                //si el usuario tiene rendiciones de cuentas pendientes
                if(isset($usuario->solicitudes) && count($usuario->solicitudes) > 0){
                    
                    $count = 0;
                    
                    foreach ($usuario->solicitudes as $solicitud) {
                        $usuario_mail->rendicionesPendientes++;  
                    }
                    
                    $usuarios_pendientes[] = $usuario_mail;
                }
            }

            foreach($usuarios_pendientes as $pendiente){
                \Mail::send('emails.viaticos.recordatorio_rendiciones', ['usuario_pendiente' => $pendiente], function($message) use ($pendiente) {
                        $message->to($pendiente->email, $pendiente->fullName);
                        $message->subject('¡Tiene rendiciones de cuentas pendientes!');
                    });
            }

        }catch(\Exception $e){
            \Log::error($e->getMessage());
        }
        /**** FIN MAIL CITAS PROXIMAS ****/

    }
}

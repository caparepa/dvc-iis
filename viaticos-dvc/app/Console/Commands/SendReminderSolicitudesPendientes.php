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
    protected $signature = 'reminders:send-reminder-citas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envía recordatorio por mail de citas próximas.';

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
            //Busco primero los asesores y sus citas confirmadas en los proximos 2 dias
            //si no tienen citas en ese lapso de tiempo, el objeto "citas" viene vacio
            $asesores = Usuario::getUsuariosSolicitudesPendientes();

            //lista de datos de cada cita por mail
            //listado de asesores a los que se le enviaran los recordatorios
            $citas_mail = [];
            $listado_asesores = [];
            $fecha_actual = new DateTime('now');
            $tomorrow = $fecha_actual->modify('+1 day');
            $tomorrow = $tomorrow->format('d-m-Y');
            
            //contruyo el objeto con los datos de cada cita para enviar en el mail
            foreach ($asesores as $asesor) {

               

                //Objeto generico para el asesor
                $asesor_mail = new \stdClass();
                $asesor_mail->fullName = $asesor->fullName;
                $asesor_mail->email = $asesor->email;

                //si el asesor tiene citas
                
                if(isset($asesor->citas) && (count($asesor->citas) > 0)){
                    foreach ($asesor->citas as $cita) {
                        print($cita->id."\n");
                        $fecha = new DateTime( $cita->fecha, new DateTimeZone('America/Bogota')); //objeto de fecha
                        $fecha_cita = $fecha->format('d-m-Y'); //fecha de la cita
                        $hora_cita = $fecha->format('H:i'); //hora de la cita

                        //si la cita es al dia siguiente de la fecha actual...
                        //if($fecha_cita == $tomorrow){
                            $datos_cita = new \stdClass();

                            $cliente = Cliente::find($cita->id_cliente);
                            $vehiculo = Vehiculo::find($cita->id_vehiculo);
                            $vehiculo_modelo = VehiculoModelo::find($vehiculo->id_modelo);
                            $vehiculo_version = VehiculoVersion::find($vehiculo->id_version);
                            $concesionario = Concesionario::find($cita->id_concesionario);
                            $sala = Sala::find($cita->id_sala);

                            $datos_cita->cliente = $cliente->nombre;
                            $datos_cita->fecha = $fecha_cita;
                            $datos_cita->hora = $hora_cita;

                            $datos_cita->concesionario = $concesionario->nombre;
                            $datos_cita->sala = $sala->nombre;
                            $datos_cita->vehiculo_modelo = $vehiculo_modelo->nombre;
                            $datos_cita->vehiculo_version = $vehiculo_version->nombre;
                            $datos_cita->vehiculo_ano = $vehiculo->ano;

                            $citas_mail[] = $datos_cita;
                            $cliente->cita = $datos_cita;
                            $cliente->asesor = $asesor;
                            $clientes_email[] = $cliente;
                            
                            

                    }
                    
                    //si hay citas en el recordatorio del asesor, agregar los datos al
                    //listado de mailing a enviar
                    if(count($citas_mail) > 0){
                        $asesor_mail->citas = $citas_mail; //asignar citas al asesor
                        $listado_asesores[] = $asesor_mail; //poner el asesor en una lista para mailing
                    }

                    $citas_mail = []; 
                }
            }

            //Envio de correos a los asesores
            foreach($listado_asesores as $asesor){
                \Mail::send('emails.ce.recordatorio_cita', ['asesor' => $asesor, 'citas' => $asesor->citas], function($message) use ($asesor) {
                        $message->to($asesor->email, $asesor->fullName);
                        $message->subject('Recordatorio de citas.');
                    });
            }

            foreach($clientes_email as $cliente){
                
                \Mail::send('emails.ce.recordatorio_cita_cliente',['cliente'=>$cliente],function($message) use($cliente){
                    $message->to($cliente->email,$cliente->nombre);
                    $message->subject('Recordatorio de Solicitud');
                });
            }

        }catch(\Exception $e){
            \Log::error($e->getMessage());
        }
        /**** FIN MAIL CITAS PROXIMAS ****/
    }
}

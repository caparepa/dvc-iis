<?php

namespace App\Console\Commands;

use DB;
use Log;
use Exception;
use DateTime;
use DateTimeZone;

use App\Models\RendicionCuenta;
use App\Models\Solicitud;
use App\Models\Usuario;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ChageStatusRendicionesSolicitudes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:change-status-rendiciones-solicitudes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revisa las solicitudes aprobadas que hayan pasado su fecha de ejecucion y cambia status a rendicion de cuentas';

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

        $now = new DateTime();
        $now->format('Y-m-d H:i:s');

        //este comando se ejecutará diariamente en la madrugada o pasada la medianoche (definir)
        //al ejecutarse, se cambian status
        if(Solicitud::cambiarStatusRendicionesSolicitudes()){
            Log::info('Command::ChangeStatusRendicionesSolicitudes -> success. Date: '.$now);
        }else{
            Log::error('Command::ChangeStatusRendicionesSolicitudes -> fail. Date: '.$now);
        }
        /**
         * NOTA: como el cambio de status se realiza en el modelo, no se utiliza un bloque try-catch en este
         * comando, para no propagar posibles excepciones
         */

    }
}

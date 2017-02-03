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

class ChangeStatusRendicionesSolicitudes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schtask:change-status-rendiciones-solicitudes';

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

        try {

            DB::beginTransaction();

            $count = 0; //contador de control

            //ajusto la fecha
            $now = new DateTime();
            $now->setTimeZone(new DateTimeZone("America/Caracas"));
            $fecha = $now->format('Y-m-d H:i:s'); //for logging

            $clone = clone $now;
            $clone->modify('-1 day');
            $yesterday = $clone->format('Y-m-d');

            //query de control/debug
            /*$q = Solicitud::whereRaw('(SELECT CONVERT(VARCHAR(10),[solicitudes].[fecha_solicitud] , 120) AS [YYYY-MM-DD]) = \''.$yesterday.'\'')
                            ->whereRaw('[solicitudes].[status] = \''.self::STATUS_APPROVED.'\'')
                            ->toSql();
            Log::info($q);*/
            
            //consulto las solicitudes que hayan sido aprobadas, y cuya fecha de solicitud (ejecucion) sea el dia de ayer
            //NOTA: para los RAW del query se utiliza la convencion de sql server [tabla].[atributo]
            //NOTA: no existe un DATE_FORMAT() en SQLServer, se debe hacer una conversion con un select,
            //mas info aqui: http://www.sql-server-helper.com/tips/date-formats.aspx
            $solicitudes = Solicitud::whereRaw('(SELECT CONVERT(VARCHAR(10),[solicitudes].[fecha_solicitud] , 120) AS [YYYY-MM-DD]) = \''.$yesterday.'\'')
                            ->whereRaw('[solicitudes].[status] = \''.self::STATUS_APPROVED.'\'')
                            ->get();            

            $total_solicitudes = count($solicitudes);

            foreach ($solicitudes as $solicitud) {
                //cambiar status de solicitud
                $solicitud->status = self::STATUS_ACCOUNT;
                $solicitud->save();

                //crear nueva rendicion de cuentas
                $rendicion = new RendicionCuenta();
                $rendicion->id_solicitud = $solicitud->id;
                $rendicion->id_solicitante = $solicitud->id_usuario;
                $rendicion->save();
                
                $count++;
            }

            if($total_solicitudes == $count){
                Log::info('Command::ChangeStatusRendicionesSolicitudes -> success. Date: '.$fecha);
                
            }else{
                throw new Exception('Command::ChangeStatusRendicionesSolicitudes -> fail. Date: '.$fecha,1);
            }

            DB::commit(); //cierro transaccion

            
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();   
            
        }

    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        
        $this->call(SeederAreas::class);
        $this->call(SeederCuentas::class);
        $this->call(SeederUsuarios::class);
        
        /*if( App::environment('local') ) {
            $this->call(SeederUsuarios::class);
            $this->call(SeederCitas::class);
            $this->call(SeederUsuariosConcesionarios::class);
            $this->call(SeederCitasTecnologias::class);
        }
        
        if( App::environment('prod') ) {
            //
            $this->call(SeederUsuariosProduccion::class);
        }*/

        Model::reguard();
    }
}

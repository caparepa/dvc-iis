<?php

use Illuminate\Database\Seeder;
use App\Models\RazonSocial;

class SeederRazonSocial extends Seeder
{

	protected $records = [
		[ 'nombre' => 'SENIAT' ],
		[ 'nombre' => 'CANTV' ],
		[ 'nombre' => 'DIVIDENDO VOLUNTARIO PARA LA COMUNIDAD' ],
		[ 'nombre' => 'ESTHER CALVIS' ],
		[ 'nombre' => 'PARKING PARQUE AVILA, C.A.' ],
		[ 'nombre' => 'ESTACIONAMIENTO CENTRO SEGUROS SUDAMERICA, C.A.'],
		[ 'nombre' => 'CORPORACION 2128, C.A.'],
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach($this->records as $record) {
			$razon_social = RazonSocial::create($record);
		}
    }
}

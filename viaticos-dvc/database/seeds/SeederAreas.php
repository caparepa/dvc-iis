<?php

use App\Models\Area;
use Illuminate\Database\Seeder;

class SeederAreas extends Seeder
{

	protected $records = [

		[ 'nombre' => 'Dirección', 'descripcion' => 'Area'],
		[ 'nombre' => 'Gerencia', 'descripcion' => 'Area'],
		[ 'nombre' => 'Administración', 'descripcion' => 'Area'],
		[ 'nombre' => 'IT', 'descripcion' => 'Area'],
		[ 'nombre' => 'Captación', 'descripcion' => 'Area'],
		[ 'nombre' => 'RRHH', 'descripcion' => 'Area'],
		[ 'nombre' => 'Comunicaciones', 'descripcion' => 'Area'],
		[ 'nombre' => 'Todas', 'descripcion' => 'Area'],
		
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		foreach($this->records as $record) {
			$cita = Area::create($record);
		}

    }
}

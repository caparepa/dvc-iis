<?php

use App\Models\Area;
use Illuminate\Database\Seeder;

class SeederAreas extends Seeder
{

	protected $records = [

		[ 'id' => 1, 'nombre' => 'Dirección', 'descripcion' => 'Area'],
		[ 'id' => 2, 'nombre' => 'Gerencia', 'descripcion' => 'Area'],
		[ 'id' => 3, 'nombre' => 'Administración', 'descripcion' => 'Area'],
		[ 'id' => 4, 'nombre' => 'IT', 'descripcion' => 'Area'],
		[ 'id' => 5, 'nombre' => 'Captación', 'descripcion' => 'Area'],
		[ 'id' => 6, 'nombre' => 'RRHH', 'descripcion' => 'Area'],
		[ 'id' => 7, 'nombre' => 'Comunicaciones', 'descripcion' => 'Area'],
		[ 'id' => 8, 'nombre' => 'Todas', 'descripcion' => 'Area'],
		
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

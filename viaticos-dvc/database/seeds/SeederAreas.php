<?php

use App\Models\Area;
use Illuminate\Database\Seeder;

class SeederAreas extends Seeder
{

	protected $records = [

		[ 'nombre' => 'Dirección Ejecutiva', 'descripcion' => 'Dirección ejecutiva'],
		[ 'nombre' => 'Gerencia', 'descripcion' => 'Gerencia'],
		[ 'nombre' => 'Administración', 'descripcion' => 'Área de Administración'],
		[ 'nombre' => 'IT', 'descripcion' => 'Área de Tecnologías de Información'],
		[ 'nombre' => 'Captación', 'descripcion' => 'Área de Captación'],
		[ 'nombre' => 'RRHH', 'descripcion' => 'Area'],
		[ 'nombre' => 'Comunicaciones', 'descripcion' => 'Área de Comunicaciones'],
		[ 'nombre' => 'Voluntariado', 'descripcion' => 'Área de Voluntariado'],
		[ 'nombre' => 'Todas', 'descripcion' => 'Todas las áreas'],
		
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		foreach($this->records as $record) {
			$area = Area::create($record);
		}

    }
}

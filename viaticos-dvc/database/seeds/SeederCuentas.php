<?php

use Illuminate\Database\Seeder;
use App\Models\Cuenta;

class SeederCuentas extends Seeder
{

	//data
	protected $records = [

		[ 'nombre' => 'Personal Contratado', 'codigo' => 42200 ],
		[ 'nombre' => 'Honorarios Profesionales', 'codigo' => 42201 ],
		[ 'nombre' => 'Asambleas, Directivas y Comites', 'codigo' => 42202 ],
		[ 'nombre' => 'Servicio Electrico', 'codigo' => 42203 ],
		[ 'nombre' => 'Servicio Telefonico', 'codigo' => 42204 ],
		[ 'nombre' => 'Reparacion Mantenimiento Ofic.', 'codigo' => 42205 ],
		[ 'nombre' => 'Reparacion Mantenimiento Eqpo.', 'codigo' => 42206 ],
		[ 'nombre' => 'Depreciacion Activo Fijo', 'codigo' => 42207 ],
		[ 'nombre' => 'Gastos de Seguro', 'codigo' => 42208 ],
		[ 'nombre' => 'Impresos y Utiles de Oficina', 'codigo' => 42209 ],
		[ 'nombre' => 'Gastos de Correo', 'codigo' => 42210 ],
		[ 'nombre' => 'Gastos de Cafeteria', 'codigo' => 42211 ],
		[ 'nombre' => 'Afiliac.-Suscripciones-Cursos', 'codigo' => 42212 ],
		[ 'nombre' => 'Gastos de Representacion', 'codigo' => 42213 ],
		[ 'nombre' => 'Movilizaciones', 'codigo' => 42214 ],
		[ 'nombre' => 'Gastos Legales', 'codigo' => 42215 ],
		[ 'nombre' => 'Publicidad y Propaganda', 'codigo' => 42216 ],
		[ 'nombre' => 'Revistas y Periódicos', 'codigo' => 42217 ],
		[ 'nombre' => 'Alquileres', 'codigo' => 42218 ],
		[ 'nombre' => 'Cuentas Incobrables', 'codigo' => 42219 ],
		[ 'nombre' => 'Gastos de Computación', 'codigo' => 42220 ],
		[ 'nombre' => 'Gastos de Condominio', 'codigo' => 42221 ],
		[ 'nombre' => 'Servicios de Mensajeria', 'codigo' => 42222 ],
		[ 'nombre' => 'Perdida Diferencial Cambiario', 'codigo' => 42223 ],
		[ 'nombre' => 'Fotos', 'codigo' => 42224 ],
		[ 'nombre' => 'Pagina Web', 'codigo' => 42225 ],
		[ 'nombre' => 'CTA 4.20.02.26', 'codigo' => 42226 ],
		[ 'nombre' => 'Perdida en venta de activo', 'codigo' => 42227 ],
		[ 'nombre' => 'Gastos de Internet', 'codigo' => 42228 ],
		[ 'nombre' => 'Campala-Tarjeta de Credito', 'codigo' => 42229 ],
		[ 'nombre' => 'Gastos de Vehiculos', 'codigo' => 42230 ],
		[ 'nombre' => 'Seguro de Accidentes personales', 'codigo' => 42231 ],
		[ 'nombre' => 'Estacionamiento', 'codigo' => 42232 ],

	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->records as $record) {
			$cuenta = Cuenta::create($record);
		}
    }
}

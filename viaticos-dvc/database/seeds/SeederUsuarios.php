<?php

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class SeederUsuarios extends Seeder
{

	protected $records = [];
	
	public function __construct() {
		$this->records = [
			[
				'nombre' => 'Administrador',
				'apellido' => 'DVC',
				'telefono_hab' => null,
				'telefono_cell' => null,
				'cedula' => null,
				'rif' => null,
				'email' => 'admin@dvc.com',
				'password' => bcrypt('qwerty'),
				'avatar' => Usuario::DEFAULT_AVATAR,
				'rol' => Usuario::ROL_ADMIN,
				'status' => Usuario::STATUS_ACTIVE
			],
			[
				'nombre' => 'Usuario',
				'apellido' => 'DVC',
				'telefono_hab' => '02127537697',
				'telefono_cell' => '04127377790',
				'cedula' => 'V-19204856',
				'rif' => null,
				'email' => 'usuario@dvc.com',
				'password' => bcrypt('qwerty'),
				'avatar' => Usuario::DEFAULT_AVATAR,
				'rol' => Usuario::ROL_USUARIO,
				'status' => Usuario::STATUS_ACTIVE
			],
			[
				'nombre' => 'Administracion',
				'apellido' => 'DVC',
				'telefono_hab' => null,
				'telefono_cell' => null,
				'cedula' => null,
				'rif' => null,
				'email' => 'gadmin@dvc.com',
				'password' => bcrypt('qwerty'),
				'avatar' => Usuario::DEFAULT_AVATAR,
				'rol' => Usuario::ROL_ADMINISTRACION,
				'status' => Usuario::STATUS_ACTIVE
			],
		];
	}


	/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	foreach($this->records as $record) {
			$usuario = Usuario::create($record);
		}

    }
    
}

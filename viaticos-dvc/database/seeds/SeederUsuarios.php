<?php

use Illuminate\Database\Seeder;
use App\Models\User;

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
				'avatar' => User::DEFAULT_AVATAR,
				'rol' => User::ROL_ADMIN,
				'status' => User::STATUS_ACTIVE
			],
			[
				'nombre' => 'Christopher',
				'apellido' => 'Serrano',
				'telefono_hab' => '02127537697',
				'telefono_cell' => '04127377790',
				'cedula' => 'V-19204856',
				'rif' => null,
				'email' => 'serrano.cjm@gmail.com',
				'password' => bcrypt('qwerty'),
				'avatar' => User::DEFAULT_AVATAR,
				'rol' => User::ROL_USUARIO,
				'status' => User::STATUS_ACTIVE
			],
			[
				'nombre' => 'Gerencia',
				'apellido' => 'DVC',
				'telefono_hab' => null,
				'telefono_cell' => null,
				'cedula' => null,
				'rif' => null,
				'email' => 'gerencia@dvc.com',
				'password' => bcrypt('qwerty'),
				'avatar' => User::DEFAULT_AVATAR,
				'rol' => User::ROL_GERENCIA,
				'status' => User::STATUS_ACTIVE
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
			$usuario = User::create($record);
		}

    }
    
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        

        Schema::create('areas', function (Blueprint $table) {
            $table->increments('id')
                ->unsigned();
            $table->string('nombre');
            $table->string('descripcion');
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')
                ->unsigned();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('cedula')
                ->nullable();
            $table->string('rif')
                ->nullable();
            $table->string('telefono_hab')
                ->nullable();
            $table->string('telefono_cell')
                ->nullable();
            $table->string('email')
                ->unique();
            $table->string('password', 60);
            $table->string('avatar', 255)
                ->nullable();

            $table->string('rol');
            $table->string('status');
            $table->integer('id_area')
                    ->unsigned();
            $table->rememberToken();
            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_area')
                    ->references('id')
                    ->on('areas')
                    ->onDelete('cascade');
        });


        


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropIfExists('users');
        Schema::dropIfExists('areas');
        

    }
}
      
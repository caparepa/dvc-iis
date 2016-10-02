<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Solicitudes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          //
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('asunto');
            $table->string('area');
            $table->string('beneficiario');
            $table->string('cedula')->nullable();
            $table->string('rif')->nullable();
            $table->timestamp('fecha_solicitud');
            $table->string('descripcion');
            $table->float('monto')->nullable();
            $table->integer('id_usuario');
            $table->integer('id_area');
            $table->integer('id_cuenta');
            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_usuario')
                    ->references('id')
                    ->on('users');

            $table->foreign('id_area')
                    ->references('id')
                    ->on('areas');

            $table->foreign('id_cuenta')
                    ->references('id')
                    ->on('cuentas');
        });


        Schema::create('historico_solicitudes', function (Blueprint $table) {
            $table->integer('id_solicitud');
            $table->integer('id_revisor')
                ->nullable();
            $table->date('fecha');
            $table->string('status');

            $table->foreign('id_solicitud')
                    ->references('id')
                    ->on('solicitudes');

            $table->foreign('id_revisor')
                    ->references('id')
                    ->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historico_solicitudes');
        Schema::dropIfExists('solicitudes');
    }
}

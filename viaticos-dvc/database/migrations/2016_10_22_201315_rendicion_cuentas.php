<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RendicionCuentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rendicion_cuentas', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')
                    ->unsigned();
            $table->float('monto_total');
            $table->string('status');

            $table->integer('id_solicitud')
                    ->unsigned()
                    ->nullable();
            $table->integer('id_solicitante')
                    ->unsigned()
                    ->nullable();
            $table->integer('id_revisor')
                    ->unsigned()
                    ->nullable();

            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('gastos', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id')
                    ->unsigned();
            $table->timestamp('fecha');
            $table->string('nombre_empresa');
            $table->text('descripcion')
                    ->nullable();
            $table->float('monto')
                    ->nullable();

            $table->integer('id_rendicion')
                    ->unsigned()
                    ->nullable();

            $table->timestamps();

        });

        //hay que crear las foreign key sin cascade, porque a sql server no le gusta ¬¬
        Schema::table('rendicion_cuentas', function (Blueprint $table) {
          
            $table->foreign('id_solicitud')
                    ->references('id')
                    ->on('solicitudes');

            $table->foreign('id_solicitante')
                    ->references('id')
                    ->on('usuarios');

            $table->foreign('id_revisor')
                    ->references('id')
                    ->on('usuarios');

        });

        Schema::table('gastos', function (Blueprint $table) {

            $table->foreign('id_rendicion')
                    ->references('id')
                    ->on('rendicion_cuentas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //hay que eliminar los constraints y las columnas de loas fk para
        //poder hacer el rollback... porque a sql server no le gustan los ciclos ¬¬
        Schema::table('rendicion_cuentas', function(Blueprint $table) {
            $table->dropForeign('rendicion_cuentas_id_solicitud_foreign');
            $table->dropColumn('id_solicitud');
            $table->dropForeign('rendicion_cuentas_id_solicitante_foreign');
            $table->dropColumn('id_solicitante');
            $table->dropForeign('rendicion_cuentas_id_revisor_foreign');
            $table->dropColumn('id_revisor');
        });

        Schema::table('gastos', function (Blueprint $table) {
            $table->dropForeign('gastos_id_rendicion_foreign');
            $table->dropColumn('id_rendicion');
        });

        Schema::dropIfExists('gastos');
        Schema::dropIfExists('rendicion_cuentas');

    }
}

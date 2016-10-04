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
        
        

        Schema::create('solicitudes', function (Blueprint $table) {
            $table->increments('id')
                    ->unsigned();
            $table->string('asunto');
            $table->string('area');
            $table->string('beneficiario');
            $table->string('cedula')
                    ->nullable();
            $table->string('rif')
                    ->nullable();
            $table->timestamp('fecha_solicitud');
            $table->string('descripcion');
            $table->float('monto')
                    ->nullable();
            $table->integer('id_usuario')
                    ->unsigned();
            $table->integer('id_cuenta')
                    ->unsigned();
            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_usuario')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

            $table->foreign('id_cuenta')
                    ->references('id')
                    ->on('cuentas')
                    ->onDelete('cascade');
        });


        Schema::create('historico_solicitudes', function (Blueprint $table) {
            $table->integer('id_solicitud')
                    ->unsigned();
            $table->integer('id_revisor')
                    ->unsigned()
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

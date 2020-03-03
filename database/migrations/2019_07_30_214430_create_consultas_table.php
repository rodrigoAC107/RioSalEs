<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('legajo_id');
            // $table->unsignedBigInteger('enfermedad_id');
            $table->unsignedBigInteger('signo_id');
            $table->date('fecha_consulta');
            $table->string('tipo_consulta');
            $table->string('motivo');
            $table->foreign('legajo_id')->references('legajo')->on('empleados');
            // $table->foreign('enfermedad_id')->references('id')->on('enfermedades');
            $table->foreign('signo_id')->references('id')->on('signos_vitales');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultas', function (Blueprint $table) {
           $table->dropForeign('consultas_legajo_id_foreign');
        //    $table->dropForeign('consultas_enfermedad_id_foreign');
           $table->dropForeign('consultas_signo_id_foreign');
        });
    }
}

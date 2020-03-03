<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAntecedentesEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedentes_empleados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('legajo_id');
            $table->unsignedBigInteger('consulta_id')->nullable();
            $table->string('tipo');
            $table->string('observacion');
            $table->foreign('legajo_id')->references('legajo')->on('empleados');
            $table->foreign('consulta_id')->references('id')->on('consultas');
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
        Schema::dropIfExists('antecedentes_empleados', function (Blueprint $table) {
            $table->dropForeign('antecedentes_empleados_legajo_id_foreign');
            $table->dropForeign('antecedentes_empleados_consultas_id_foreign');
        });
    }
}

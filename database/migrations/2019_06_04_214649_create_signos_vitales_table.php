<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignosVitalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signos_vitales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('legajo_id');
            $table->integer('temperatura');
            $table->integer('sistolica');
            $table->integer('diastolica');
            $table->integer('frecuencia_arterial');
            $table->integer('frecuencia_respiratoria');
            $table->foreign('legajo_id')->references('legajo')->on('empleados');
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
        Schema::table('signos_vitales', function (Blueprint $table) {
            $table->dropForeign('signos_vitales_id_legajo_foreign');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacunas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('legajo_id');
            $table->date('fecha')->nullable();
            $table->string('nombre')->nullable();
            $table->string('dosis_1')->nullable();
            $table->string('dosis_2')->nullable();
            $table->string('dosis_3')->nullable();
            $table->string('estado')->nullable();
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
        Schema::dropIfExists('vacunas', function (Blueprint $table) {
            $table->dropForeign('vacunas_legajo_id_foreign');
        });
    }
}

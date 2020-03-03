<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateControlVacunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_vacunas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('legajo_id');
            $table->float('porcentaje');
            $table->string('cantidad');
            $table->string('total_vacunas');
            $table->string('estado');
            $table->string('color');
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
        Schema::dropIfExists('control_vacunas');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonacionAnioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donacion_anio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('legajo_id');
            $table->date('fecha_1')->nullable();
            $table->date('fecha_2')->nullable();
            $table->date('fecha_3')->nullable();
            $table->integer('total')->nullable();
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
        Schema::dropIfExists('donacion_anio', function (Blueprint $table) {
            $table->dropForeign('donacion_anio_legajo_id_foreign');
       });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('legajo_id');
            $table->date('fecha_1')->nullable();
            $table->date('fecha_2')->nullable();
            $table->date('fecha_3')->nullable();
            $table->integer('total');
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
        Schema::dropIfExists('donaciones', function (Blueprint $table) {
            $table->dropForeign('donaciones_legajo_id_foreign');
        });
    }
}

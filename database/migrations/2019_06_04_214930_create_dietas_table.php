<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDietasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dietas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('legajo_id');
            $table->string('tipo_1');
            $table->string('tipo_2')->nullable();
            $table->string('comidas_permitidas');
            $table->string('comidas_no_permitidas');
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
        Schema::dropIfExists('dietas', function (Blueprint $table) {
            $table->dropForeign('dietas_legajo_id_foreign');
        });
    }
}

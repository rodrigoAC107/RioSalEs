<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedImcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('legajo_id');
            $table->float('estatura');
            $table->float('peso');
            $table->float('calculo_imc');
            $table->string('estado');
            $table->string('color');
            $table->foreign('legajo_id')->references('legajo')->on('empleados');
            $table->timestamps();
        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imc', function (Blueprint $table) {
            $table->dropForeign('imc_legajo_id_foreign');
        });
       
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramaVacunacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programa_vacunacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('vacuna');
            $table->string('area');
            $table->string('dosis');
            $table->date('fecha');
            // $table->string('notificar');
            $table->string('mensaje');
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
        Schema::dropIfExists('programa_vacunacion');
    }
}

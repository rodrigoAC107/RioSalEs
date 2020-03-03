<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            
            $table->string('legajo')->unique();
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('area_trabajo')->nullable();
            $table->string('cargo')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('cuil')->nullable();
            $table->integer('edad')->nullable();
            $table->string('email')->nullable();
            $table->string('sexo')->nullable();
            $table->string('domicilio')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->date('fecha_alta')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('grupo_sanguineo')->nullable();
            $table->string('telefono')->nullable();
            $table->string('imagen')->nullable();
            $table->string('anteojos')->nullable();
            // $table->foreign('area_trabajo')->references('id')->on('areas');
            

            $table->primary('legajo');
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
        Schema::dropIfExists('empleados', function (Blueprint $table) {
            $table->dropPrimary('legajo');
            $table->dropForeign('empleados_area_trabajo_foreign');
        });
    }
}

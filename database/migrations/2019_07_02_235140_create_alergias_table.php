<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlergiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alergias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('legajo_id');
            $table->string('tipo');
            $table->string('observacion');
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
        
        Schema::dropIfExists('alergias', function (Blueprint $table) {
            $table->dropForeign('alergias_legajo_id_foreign');
        });
        
    }
}

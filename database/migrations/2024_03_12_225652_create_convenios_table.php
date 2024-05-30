<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConveniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convenios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('diasCarencia');
            $table->boolean('geraReceitas')->nullable();
            $table->string('numeroderegistro')->nullable();
            $table->string('codigonaoperadora')->nullable();
            $table->string('versaoxml')->nullable();
            $table->string('tabela')->nullable();
            $table->integer('maxSessoesTiss')->nullable();
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
        Schema::dropIfExists('convenios');
    }
}

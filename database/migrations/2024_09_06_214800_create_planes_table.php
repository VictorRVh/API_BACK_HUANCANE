<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('planes', function (Blueprint $table) {
            $table->id('id_plan');
            $table->string('nombre_plan');
            $table->unsignedBigInteger('id_especialidad');  // Definir el tipo manualmente
            $table->foreign('id_especialidad')->references('id_especialidad')->on('especialidades')->onDelete('cascade');  // Definir manualmente la clave foránea
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planes');
    }
};

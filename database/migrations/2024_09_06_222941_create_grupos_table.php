<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->id('id_grupo'); // Clave primaria
            $table->string('nombre_grupo');
            $table->foreignId('id_sede')->constrained('sedes', 'id_sede')->onDelete('cascade');
            $table->foreignId('id_turno')->constrained('turnos', 'id')->onDelete('cascade');
            $table->foreignId('id_especialidad')->constrained('especialidades', 'id_especialidad')->onDelete('cascade');
            $table->foreignId('id_plan')->constrained('planes', 'id_plan')->onDelete('cascade');
            $table->unsignedBigInteger('id_docente'); // Clave foránea
            $table->foreign('id_docente')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};

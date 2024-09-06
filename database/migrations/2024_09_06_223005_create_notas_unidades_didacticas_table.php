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
        Schema::create('notas_unidades_didacticas', function (Blueprint $table) {
            $table->id('id_nota');
            $table->integer('nota');
            $table->unsignedBigInteger('id_unidad_didactica'); // Asegúrate de que el tipo de dato coincida
            $table->foreign('id_unidad_didactica')->references('id_unidad_didactica')->on('unidades_didacticas')->onDelete('cascade');
            $table->unsignedBigInteger('id_estudiante'); // Asegúrate de que el tipo de dato coincida
            $table->foreign('id_estudiante')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->unsignedBigInteger('id_docente'); // Asegúrate de que el tipo de dato coincida
            $table->foreign('id_docente')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas_unidades_didacticas');
    }
};

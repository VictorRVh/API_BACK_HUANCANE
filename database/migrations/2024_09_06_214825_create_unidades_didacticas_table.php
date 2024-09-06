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
        schema::create('unidades_didacticas', function (Blueprint $table) {
            $table->id('id_unidad_didactica');
            $table->string('nombre_unidad');
            $table->unsignedBigInteger('id_programa');  // Asegúrate de que el tipo sea bigint
            $table->foreign('id_programa')->references('id_programa')->on('programas')->onDelete('cascade');  // Definir la relación manualmente
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidades_didacticas');
    }
};

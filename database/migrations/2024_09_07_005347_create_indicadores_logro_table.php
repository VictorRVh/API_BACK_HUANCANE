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
        Schema::create('indicadores_logro', function (Blueprint $table) {
            $table->id('id_indicador'); // Definimos la clave primaria para la tabla
            $table->string('descripcion'); // Descripción del indicador de logro
            $table->unsignedBigInteger('id_unidad_didactica'); // Clave foránea que hace referencia a unidades_didacticas

            // Definimos la clave foránea que apunta a la columna id_unidad_didactica en la tabla unidades_didacticas
            $table->foreign('id_unidad_didactica')
                  ->references('id_unidad_didactica')
                  ->on('unidades_didacticas')
                  ->onDelete('cascade'); // Elimina los indicadores de logro cuando se elimina una unidad didáctica

            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicadores_logro');
    }
};

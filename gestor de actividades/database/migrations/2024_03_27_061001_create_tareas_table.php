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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id('id_tarea');
            $table->string('nombre')->unique();
            $table->text('descripcion')->nullable();
            $table->date('fecha');
            $table->time('hora')->nullable();  // Cambiado a tipo 'time'
            $table->decimal('prioridad', 8, 1);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};

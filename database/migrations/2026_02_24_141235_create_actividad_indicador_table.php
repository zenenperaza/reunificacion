<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('actividad_indicador', function (Blueprint $table) {
            $table->id();

            $table->foreignId('indicador_proyecto_id')
                ->constrained('indicador_proyecto')
                ->cascadeOnDelete();

            $table->foreignId('actividad_id')
                ->constrained('actividades')
                ->cascadeOnDelete();

            
            $table->boolean('estatus')->default(true);
            $table->unsignedBigInteger('meta')->nullable();

            $table->timestamps();

            $table->unique(['indicador_proyecto_id', 'actividad_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actividad_indicador');
    }
};
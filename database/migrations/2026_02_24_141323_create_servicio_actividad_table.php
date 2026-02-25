<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('servicio_actividad', function (Blueprint $table) {
            $table->id();

            $table->foreignId('actividad_indicador_id')
                ->constrained('actividad_indicador')
                ->cascadeOnDelete();

            $table->foreignId('servicio_id')
                ->constrained('servicios')
                ->cascadeOnDelete();

            $table->boolean('estatus')->default(true);
            $table->unsignedBigInteger('cantidad_disponible')->nullable();

            $table->timestamps();

            $table->unique(['actividad_indicador_id', 'servicio_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servicio_actividad');
    }
};
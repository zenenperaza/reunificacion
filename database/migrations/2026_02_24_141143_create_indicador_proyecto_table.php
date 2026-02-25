<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('indicador_proyecto', function (Blueprint $table) {
            $table->id();

            $table->foreignId('proyecto_id')
                ->constrained('proyectos')
                ->cascadeOnDelete();

            $table->foreignId('indicador_id')
                ->constrained('indicadores')
                ->cascadeOnDelete();
            
            $table->boolean('estatus')->default(true);
            $table->unsignedBigInteger('meta_cuantitativa')->nullable();
            $table->string('meta_cualitativa')->nullable();

            $table->timestamps();

            $table->unique(['indicador_id', 'proyecto_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indicador_proyecto');
    }
};
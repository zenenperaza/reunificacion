<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('municipio_proyecto', function (Blueprint $table) {

            $table->foreignId('municipio_id')
                ->constrained('municipios')
                ->cascadeOnDelete();

            $table->foreignId('proyecto_id')
                ->constrained('proyectos')
                ->cascadeOnDelete();

            $table->timestamps();

            // PK compuesta (como en tu diagrama)
            $table->primary(['municipio_id', 'proyecto_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('municipio_proyecto');
    }
};
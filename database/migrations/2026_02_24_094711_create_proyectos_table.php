<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('donante_id')
                ->constrained('donantes')
                ->cascadeOnDelete();

            
            $table->boolean('estatus')->default(true);
            $table->unsignedBigInteger('codigo')->nullable();
            $table->string('descripcion')->nullable();
            $table->date('inicio')->nullable();
            $table->date('fin')->nullable();

            $table->timestamps();

            // opcional si deseas que el codigo no se repita
            $table->unique('codigo');
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
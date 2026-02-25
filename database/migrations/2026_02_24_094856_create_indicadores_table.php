<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('indicadores', function (Blueprint $table) {
            $table->id();

            $table->string('codigo')->nullable();
            $table->string('descripcion')->nullable();

            $table->timestamps();

            // opcional si deseas que el codigo no se repita
            // $table->unique('codigo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indicadores');
    }
};
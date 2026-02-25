<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->id();

            $table->string('codigo')->nullable();   // varchar
            $table->string('descripcion')->nullable();

            $table->timestamps();

            // Opcional: si el código debe ser único
            // $table->unique('codigo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actividades');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('donantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->boolean('estatus')->default(true);
            $table->json('enlaces')->nullable(); // JSON: { nombre_contacto, telefono }
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donantes');
    }
};
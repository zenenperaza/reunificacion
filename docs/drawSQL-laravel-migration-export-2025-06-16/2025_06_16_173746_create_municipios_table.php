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
        Schema::disableForeignKeyConstraints();

        Schema::create('municipios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('name');
            $table->bigInteger('created_at');
            $table->bigInteger('updated_at');
            $table->bigInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('estados');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('municipios');
    }
};

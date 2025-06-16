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

        Schema::create('parroquia', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('name');
            $table->bigInteger('municipio_id');
            $table->foreign('municipio_id')->references('id')->on('municipios');
            $table->bigInteger('created_at');
            $table->bigInteger('updated_at');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parroquia');
    }
};

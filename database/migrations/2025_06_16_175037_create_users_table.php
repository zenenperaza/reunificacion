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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('es_superior')->default(false);
            $table->enum('estatus', ['activo', 'inactivo'])->default('activo');

            // Familia a la que pertenece el usuario (ej: Zulia, Táchira)
            // $table->string('familia')->nullable();

            // Usuario superior (padre)
            $table->foreignId('parent_id')->nullable()->constrained('users')->onDelete('set null');

            // Si puede ver casos de sus hermanos en la familia
            // $table->boolean('ver_entre_hermanos')->default(false);

            $table->timestamps();
        });


        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

<?php

// database/migrations/xxxx_xx_xx_create_configuraciones_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracionesTable extends Migration
{
    public function up()
    {
        Schema::create('configuraciones', function (Blueprint $table) {
            $table->id();
            $table->string('conf_fecha_actual')->nullable(); // puede ser 'si' o 'no'
            $table->string('sistema_deshabilitado')->nullable()->default('no');
            $table->string('periodo')->nullable()->default(null);
            $table->string('nombre_sistema')->nullable(); // Nombre del sistema
            $table->string('logo_sistema')->nullable();   // Ruta al logo en storage o public
            $table->text('texto_portada')->nullable();
            $table->string('imagen_portada')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('configuraciones');
    }
}

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
            $table->string('clave')->unique(); // Ej: 'nombre_sistema'
            $table->text('valor')->nullable(); // Puede ser texto, JSON, etc.
            $table->string('descripcion')->nullable(); // Explicación del uso
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('configuraciones');
    }
}


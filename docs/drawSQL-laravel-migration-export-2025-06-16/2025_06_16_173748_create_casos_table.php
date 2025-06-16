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

        Schema::create('casos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('periodo');
            $table->string('fecha_atencion');
            $table->bigInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->bigInteger('municipio_id');
            $table->bigInteger('parroquia_id');
            $table->bigInteger('elaborado_por');
            $table->string('numero_caso');
            $table->string('organizacion_programa');
            $table->string('organizacion_solicitante');
            $table->string('otras_organizaciones');
            $table->string('tipo_atension_programa');
            $table->string('tipo_atencion');
            $table->string('beneficiario');
            $table->string('estado_mujer');
            $table->bigInteger('edad_beneficiario');
            $table->string('poblacion_lgbti');
            $table->string('acompanante');
            $table->string('representante_legal');
            $table->string('pais_procedencia');
            $table->string('otro_pais');
            $table->string('nacionalidad_solicitante');
            $table->string('pais_nacimiento');
            $table->string('otro_pais_nacimiento');
            $table->string('tipo_documento');
            $table->string('etnia_indigena');
            $table->string('discapacidad');
            $table->string('educacion');
            $table->string('nivel_educativo');
            $table->bigInteger('tipo_institucion');
            $table->string('servicio_brindado_cosude');
            $table->string('servicio_brindado_unicef');
            $table->string('estado_destino_id');
            $table->string('municipio_destino');
            $table->string('parroquia_destino');
            $table->string('direccion_domicilio');
            $table->string('numero_contacto');
            $table->string('tipo_actuacion');
            $table->string('otro_tipo_actuacion');
            $table->string('vulnerabilidades');
            $table->string('derechos_vulnerados');
            $table->string('identificacion_violencia');
            $table->string('tipos_violencia_vicaria');
            $table->string('remisiones');
            $table->string('otras_remisiones');
            $table->string('fotos');
            $table->string('archivos');
            $table->string('fecha_actual');
            $table->bigInteger('estatus');
            $table->string('indicadores');
            $table->string('observaciones');
            $table->bigInteger('verificador');
            $table->string('created_at');
            $table->string('updated_at');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('casos');
    }
};

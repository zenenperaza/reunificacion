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
        Schema::create('casos', function (Blueprint $table) {
        $table->id();
        
        $table->foreignId('user_id')->constrained()->onDelete('restrict');

        $table->string('periodo')->nullable();
        $table->date('fecha_atencion')->nullable();

        $table->foreignId('estado_id')->constrained('estados')->onDelete('restrict');
        $table->foreignId('municipio_id')->constrained('municipios')->onDelete('restrict');
        $table->foreignId('parroquia_id')->constrained('parroquias')->onDelete('restrict');

        $table->string('elaborado_por')->nullable();
        $table->string('numero_caso')->nullable();
        $table->string('organizacion_programa')->nullable();
        $table->string('organizacion_solicitante')->nullable();
        $table->string('otras_organizaciones')->nullable();

        $table->string('tipo_atencion_programa')->nullable(); 
        $table->string('tipo_atencion')->nullable();

        $table->string('beneficiario')->nullable();
        $table->string('estado_mujer')->nullable();
        $table->integer('edad_beneficiario')->nullable();
        $table->string('poblacion_lgbti')->nullable();

        $table->string('acompanante')->nullable();
        $table->string('representante_legal')->nullable();

        $table->string('pais_procedencia')->nullable();
        $table->string('otro_pais')->nullable();
        $table->string('nacionalidad_solicitante')->nullable();
        $table->string('pais_nacimiento')->nullable();
        $table->string('otro_pais_nacimiento')->nullable();

        $table->string('tipo_documento')->nullable();
        $table->string('etnia_indigena')->nullable();
        $table->string('otra_etnia')->nullable();
        $table->string('discapacidad')->nullable();

        $table->string('educacion')->nullable();
        $table->string('nivel_educativo')->nullable();
        $table->string('tipo_institucion')->nullable(); 

        $table->text('servicio_brindado_cosude')->nullable(); 
        $table->text('servicio_brindado_unicef')->nullable(); 

        $table->foreignId('estado_destino_id')->nullable()->constrained('estados')->onDelete('restrict');
        $table->foreignId('municipio_destino_id')->nullable()->constrained('municipios')->onDelete('restrict');
        $table->foreignId('parroquia_destino_id')->nullable()->constrained('parroquias')->onDelete('restrict');

        $table->string('direccion_domicilio')->nullable();
        $table->string('numero_contacto')->nullable();

        $table->string('tipo_actuacion')->nullable();
        $table->string('otro_tipo_actuacion')->nullable();

        $table->longText('vulnerabilidades')->nullable(); // Puede migrar a JSON o tabla pivote
        $table->longText('derechos_vulnerados')->nullable(); // idem

        $table->longText('identificacion_violencia')->nullable();
        $table->longText('tipos_violencia_vicaria')->nullable();

        $table->longText('remisiones')->nullable();
        $table->string('otras_remisiones')->nullable();

        $table->longText('fotos')->nullable();
        $table->longText('archivos')->nullable();


        $table->date('fecha_actual')->nullable();
        $table->string('estatus')->nullable();
        $table->text('indicadores')->nullable();

        $table->longText('observaciones')->nullable();

        $table->integer('verificador')->nullable();
        $table->string('condicion')->nullable();

        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('casos');
    }
};

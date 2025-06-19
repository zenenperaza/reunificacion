<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caso extends Model
{

    

     protected $fillable = [
        'user_id', 'periodo', 'fecha_atencion', 'estado_id', 'municipio_id', 'parroquia_id',
        'elaborado_por', 'numero_caso', 'organizacion_programa', 'organizacion_solicitante',
        'otras_organizaciones', 'tipo_atencion_programa', 'tipo_atencion', 'beneficiario',
        'estado_mujer', 'edad_beneficiario', 'poblacion_lgbti', 'acompanante',
        'representante_legal', 'pais_procedencia', 'otro_pais', 'nacionalidad_solicitante',
        'pais_nacimiento', 'otro_pais_nacimiento', 'tipo_documento', 'etnia_indigena', 'otra_etnia',
        'discapacidad', 'educacion', 'nivel_educativo', 'tipo_institucion',
        'servicio_brindado_cosude', 'servicio_brindado_unicef', 'estado_destino_id',
        'municipio_destino_id', 'parroquia_destino_id', 'direccion_domicilio',
        'numero_contacto', 'tipo_actuacion', 'otro_tipo_actuacion', 'vulnerabilidades',
        'derechos_vulnerados', 'identificacion_violencia', 'tipos_violencia_vicaria',
        'remisiones', 'otras_remisiones', 'fotos', 'archivos', 'fecha_actual',
        'estatus', 'indicadores', 'observaciones', 'verificador', 'condicion',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function parroquia()
    {
        return $this->belongsTo(Parroquia::class);
    }

    public function estadoDestino()
    {
        return $this->belongsTo(Estado::class, 'estado_destino_id');
    }

    public function municipioDestino()
    {
        return $this->belongsTo(Municipio::class, 'municipio_destino_id');
    }

    public function parroquiaDestino()
    {
        return $this->belongsTo(Parroquia::class, 'parroquia_destino_id');
    }
}

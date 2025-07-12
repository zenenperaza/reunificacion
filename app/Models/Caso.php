<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

use Illuminate\Database\Eloquent\SoftDeletes;







class Caso extends Model
{


    use HasFactory, LogsActivity, SoftDeletes;

    protected $casts = [
        'fecha_actual' => 'date',
        'fecha_atencion' => 'date',
    ];

    protected $fillable = [
        'user_id',
        'periodo',
        'fecha_atencion',
        'estado_id',
        'municipio_id',
        'parroquia_id',
        'elaborado_por',
        'numero_caso',
        'organizacion_programa',
        'organizacion_solicitante',
        'otras_organizaciones',
        'tipo_atencion_programa',
        'tipo_atencion',
        'beneficiario',
        'estado_mujer',
        'edad_beneficiario',
        'poblacion_lgbti',
        'acompanante',
        'representante_legal',
        'pais_procedencia',
        'otro_pais',
        'nacionalidad_solicitante',
        'pais_nacimiento',
        'otro_pais_nacimiento',
        'tipo_documento',
        'etnia_indigena',
        'otra_etnia',
        'discapacidad',
        'educacion',
        'nivel_educativo',
        'tipo_institucion',
        'servicio_brindado_cosude',
        'servicio_brindado_unicef',
        'estado_destino_id',
        'municipio_destino_id',
        'parroquia_destino_id',
        'direccion_domicilio',
        'numero_contacto',
        'tipo_actuacion',
        'otro_tipo_actuacion',
        'vulnerabilidades',
        'derechos_vulnerados',
        'identificacion_violencia',
        'tipos_violencia_vicaria',
        'remisiones',
        'otras_remisiones',
        'fotos',
        'archivos',
        'fecha_actual',
        'estatus',
        'indicadores',
        'observaciones',
        'verificador',
        'condicion',
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

    protected static $logName = 'casos'; // Para que aparezca en la columna "Módulo"


    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(self::$logName)
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        $eventos = [
            'created' => 'creado',
            'updated' => 'actualizado',
            'deleted' => 'eliminado',
        ];

        $numero = $this->numero_caso ?? 'N/A';
        $accion = $eventos[$eventName] ?? $eventName;

        return "El caso {$numero} fue {$accion}";
    }


    // App\Models\Caso.php

    public static function enEspera()
    {
        return self::where('condicion', 'En espera')->latest()->take(10)->get();
    }

    public static function cantidadEnEspera()
    {
        return self::where('condicion', 'En espera')->count();
    }
}

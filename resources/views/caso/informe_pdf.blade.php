<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe de Casos</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1 { font-size: 18px; }
        p { margin-bottom: 8px; }
    </style>
</head>
<body>
    <h1>Informe de Casos - {{ now()->format('d/m/Y H:i') }}</h1>

    <p><strong>Resumen estadístico:</strong></p>
    <p>{{ $resumenLocal }}</p>

    @if($informeIA)
        <hr>
        <p><strong>Análisis generado por IA:</strong></p>
        <p style="white-space: pre-line;">{{ $informeIA }}</p>
    @endif
</body>
</html>

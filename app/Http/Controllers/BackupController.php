<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use ZipArchive;

class BackupController extends Controller
{
    // Mostrar backups disponibles
    public function index()
    {
        try {
            $files = collect(Storage::disk('backup')->files('ATENCION-PROGRAMA-RLF'))
                ->filter(fn($file) => str($file)->endsWith('.zip'))
                ->map(function ($file) {
                    return [
                        'name' => basename($file),
                        'path' => $file,
                        'size' => Storage::disk('backup')->size($file),
                        'modified' => Storage::disk('backup')->lastModified($file),
                    ];
                })
                ->sortByDesc('modified');

            return view('admin.backup.index', compact('files'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error al listar backups: ' . $e->getMessage());
        }
    }

    // Crear backup solo de base de datos
    public function create()
    {
        Artisan::call('backup:run', ['--only-db' => true]);

        $zipFile = null;
        $retries = 5;
        $waitMs = 500000;

        for ($i = 0; $i < $retries; $i++) {
            usleep($waitMs);

            $files = collect(Storage::disk('backup')->files('ATENCION-PROGRAMA-RLF'))
                ->filter(fn($f) => str($f)->endsWith('.zip'))
                ->sortByDesc(fn($f) => Storage::disk('backup')->lastModified($f));

            if ($files->isNotEmpty()) {
                $zipFile = $files->first();
                break;
            }
        }

        if (!$zipFile) {
            return back()->with('error', 'Backup generado, pero no se pudo ubicar el archivo ZIP.');
        }

        session()->flash('backup_file', basename($zipFile));
        return back()->with('success', 'Backup generado exitosamente. Puedes descargarlo desde el botón.');
    }

    // Descargar un archivo de backup
    public function download($file)
    {
        $filePath = 'ATENCION-PROGRAMA-RLF/' . $file;

        if (!Storage::disk('backup')->exists($filePath)) {
            return back()->with('error', 'Archivo no encontrado.');
        }

        return response()->download(Storage::disk('backup')->path($filePath));
    }

    // Eliminar un archivo de backup
    public function delete($file)
    {
        $filePath = 'ATENCION-PROGRAMA-RLF/' . $file;

        if (!Storage::disk('backup')->exists($filePath)) {
            return back()->with('error', 'El archivo no existe.');
        }

        Storage::disk('backup')->delete($filePath);
        return back()->with('success', 'Backup eliminado.');
    }

    // Restaurar backup desde archivo ZIP
    public function restore(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file|mimes:zip|max:102400', // 100 MB máx
        ]);

        try {
            $uploaded = $request->file('backup_file');

            if (!$uploaded->isValid()) {
                return back()->with('error', 'El archivo subido no es válido.');
            }

            // Ruta temporal
            $tempPath = storage_path('app/tmp_restore');
            File::deleteDirectory($tempPath);
            File::makeDirectory($tempPath, 0755, true);

            // Mover ZIP
            $uploaded->move($tempPath, 'restore.zip');
            $zipFullPath = $tempPath . '/restore.zip';

            // Extraer
            $zip = new ZipArchive;
            $status = $zip->open($zipFullPath);
            if ($status !== true) {
                return back()->with('error', 'No se pudo abrir el archivo ZIP. Código: ' . $status);
            }

            $zip->extractTo($tempPath);
            $zip->close();

            // Buscar archivo .sql
        $sqlFile =  collect(File::allFiles($tempPath))
                ->first(fn($file) => $file->getExtension() === 'sql');

            if (!$sqlFile) {
                return back()->with('error', 'El archivo ZIP no contiene ningún archivo .sql.');
            }

            // Ejecutar SQL
            DB::unprepared(File::get($sqlFile->getRealPath()));

            return back()->with('success', 'Backup restaurado correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al restaurar: ' . $e->getMessage());
        }
    }
}

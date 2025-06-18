<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CasoUploadController extends Controller
{
    public function uploadImagenes(Request $request)
    {
        $paths = [];
        foreach ($request->file('imagenes') as $file) {
            $paths[] = Storage::disk('public')->put('casos/imagenes', $file);
        }
        return response()->json($paths);
    }

    public function uploadArchivos(Request $request)
    {
        $paths = [];
        foreach ($request->file('archivos') as $file) {
            $paths[] = Storage::disk('public')->put('casos/archivos', $file);
        }
        return response()->json($paths);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use Illuminate\Http\Request;

class FamiliaController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(Familia::class, 'familia');
    }

    public function index()
    {
        $familias = Familia::withCount('usuarios')->get();
        return view('familias.index', compact('familias'));
    }

    public function create()
    {
        return view('familias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:familias,nombre',
            'ver_entre_hermanos' => 'boolean',
        ]);

        Familia::create([
            'nombre' => $request->nombre,
            'ver_entre_hermanos' => $request->boolean('ver_entre_hermanos'),
        ]);

        return redirect()->route('familias.index')->with('success', '✅ Familia creada correctamente.');
    }

    public function edit(Familia $familia)
    {
        return view('familias.edit', compact('familia'));
    }

    public function update(Request $request, Familia $familia)
    {
        $request->validate([
            'nombre' => 'required|unique:familias,nombre,' . $familia->id,
            'ver_entre_hermanos' => 'boolean',
        ]);

        $familia->update([
            'nombre' => $request->nombre,
            'ver_entre_hermanos' => $request->boolean('ver_entre_hermanos'),
        ]);

        return redirect()->route('familias.index')->with('success', '✅ Familia actualizada correctamente.');
    }

    public function destroy(Familia $familia)
    {
        $familia->delete();
        return redirect()->route('familias.index')->with('success', '🗑️ Familia eliminada correctamente.');
    }
}

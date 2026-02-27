<?php

namespace App\Http\Controllers;

use App\Models\Donante;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class DonanteController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));

        $donantes = Donante::query()
            ->when($q, fn($qq) => $qq->where('nombre', 'like', "%{$q}%"))
            ->orderBy('nombre')
            ->paginate(15)
            ->withQueryString();

        return view('donantes.index', compact('donantes', 'q'));
    }

    public function create()
    {
        $donante = new Donante();
        return view('donantes.create', compact('donante'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        // normaliza enlaces (si vienen vacíos)
        $data['enlaces'] = $this->normalizeEnlaces($data['enlaces'] ?? null);

        Donante::create($data);

        return redirect()
            ->route('donantes.index')
            ->with('success', 'Donante creado correctamente.');
    }

    public function edit(Donante $donante)
    {
        return view('donantes.edit', compact('donante'));
    }

    public function update(Request $request, Donante $donante)
    {
        $data = $this->validated($request);

        $data['enlaces'] = $this->normalizeEnlaces($data['enlaces'] ?? null);

        $donante->update($data);

        return redirect()
            ->route('donantes.index')
            ->with('success', 'Donante actualizado correctamente.');
    }

    public function destroy(Donante $donante)
    {
        // si tiene proyectos, puedes bloquear borrado si quieres:
        // if ($donante->proyectos()->exists()) { ... }

        $donante->delete();

        return redirect()
            ->route('donantes.index')
            ->with('success', 'Donante eliminado correctamente.');
    }

    public function cambiarEstatus(Donante $donante)
    {
        $donante->estatus = ! (bool) $donante->estatus;
        $donante->save();

        return back()->with('success', 'Estatus actualizado.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'estatus' => ['nullable', 'boolean'],

            'enlaces' => ['nullable', 'array'],
            'enlaces.nombre_contacto' => ['nullable', 'string', 'max:255'],
            'enlaces.telefono' => ['nullable', 'string', 'max:50'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
        ]);
    }

    private function normalizeEnlaces($enlaces): ?array
    {
        if (!is_array($enlaces)) return null;

        $nombre = trim((string) ($enlaces['nombre_contacto'] ?? ''));
        $tel    = trim((string) ($enlaces['telefono'] ?? ''));

        // si ambos vacíos, guardamos null en vez de {}
        if ($nombre === '' && $tel === '') return null;

        return [
            'nombre_contacto' => $nombre !== '' ? $nombre : null,
            'telefono'        => $tel !== '' ? $tel : null,
        ];
    }

    public function show(Donante $donante)
    {
        $donante->load([
            'proyectos.indicadorProyecto.indicador',
            'proyectos.indicadorProyecto.actividadIndicador.actividad',
            'proyectos.indicadorProyecto.actividadIndicador.servicios'
        ]);

        return view('donantes.show', compact('donante'));
    }


    public function data(Request $request)
    {
        $query = Donante::query()->select('donantes.*');

        // filtros opcionales
        if ($request->filled('estatus') && $request->estatus !== 'all') {
            $query->where('estatus', (bool) $request->estatus);
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where('nombre', 'like', "%{$q}%");
        }

        return DataTables::of($query)
            ->addColumn('contacto', fn($d) => $d->nombre_contacto ?? '-')
            ->addColumn('telefono', fn($d) => $d->telefono_contacto ?? '-')
            ->addColumn('estatus_badge', function ($d) {
                return $d->estatus
                    ? '<span class="badge bg-success">Activo</span>'
                    : '<span class="badge bg-danger">Inactivo</span>';
            })
            ->addColumn('acciones', function ($d) {

                $puedeVer = auth()->user()->can('ver donantes');
                $puedeEditar = auth()->user()->can('editar donantes');
                $puedeEliminar = auth()->user()->can('eliminar donantes');

                if (!$puedeVer && !$puedeEditar && !$puedeEliminar) {
                    return '-';
                }

                $botones = '<div class="acciones-btns d-flex justify-content-center gap-1">';

                if ($puedeVer) {
                    $botones .= '<a href="' . route('donantes.show', $d->id) . '" class="btn btn-sm btn-primary" title="Ver">
                        <i class="mdi mdi-eye"></i>
                     </a>';
                }

                if ($puedeEditar) {
                    $botones .= '<form method="POST" action="' . route('donantes.estatus', $d->id) . '" class="d-inline">
                        ' . csrf_field() . '
                        <button class="btn btn-sm btn-warning" title="Cambiar estatus" type="submit">
                            <i class="mdi mdi-refresh"></i>
                        </button>
                     </form>';

                    $botones .= '<a href="' . route('donantes.edit', $d->id) . '" class="btn btn-sm btn-info" title="Editar">
                        <i class="mdi mdi-pencil"></i>
                     </a>';
                }

                if ($puedeEliminar) {
                    $botones .= '<button class="btn btn-sm btn-danger btn-delete"
                            title="Eliminar"
                            data-url="' . route('donantes.destroy', $d->id) . '"
                            data-nombre="' . e($d->nombre) . '">
                        <i class="mdi mdi-trash-can-outline"></i>
                     </button>';
                }

                $botones .= '</div>';

                return $botones;
            })
            ->rawColumns(['estatus_badge', 'acciones'])
            ->make(true);
    }
}

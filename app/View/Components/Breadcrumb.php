<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $title;
    public $segments;

    public function __construct($title = 'Sin título')
    {
        $this->title = $title;
        $this->segments = $this->buildSegments();
    }

    private function buildSegments()
    {
        $segments = request()->segments();
        $breadcrumbs = [];
        $url = '';

        foreach ($segments as $index => $segment) {
            if (is_numeric($segment)) continue; // Evita mostrar IDs numéricos

            $url .= '/' . $segment;
            $breadcrumbs[] = [
                'name' => $this->prettyName($segment),
                'url' => url($url),
                'active' => $index === array_key_last($segments)
            ];
        }

        return $breadcrumbs;
    }

    private function prettyName($segment)
    {
        return match ($segment) {
            'create' => 'Nuevo',
            'edit' => 'Editar',
            default => ucfirst(str_replace('-', ' ', $segment)),
        };
    }

    public function render()
    {
        return view('components.breadcrumb');
    }
}


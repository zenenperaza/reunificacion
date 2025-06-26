@extends('layouts.app')

@section('title', 'Importar Casos')

@section('content')
    <div class="container mt-4">
        <h4 class="mb-4">Importar Casos por Excel</h4>

        {{-- Formulario de carga --}}
        <form id="formPrevisualizarExcel" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 col-md-6">
                <input type="file" class="form-control" name="archivo_excel" id="archivoExcel" accept=".xlsx,.xls">
            </div>
        </form>

        {{-- Contenedor para mostrar tabla --}}
        <div id="previewContainer" class="mt-4"></div>

        {{-- Botón de confirmación --}}
        <form id="formConfirmarImportacion" action="{{ route('casos.confirmar') }}" method="POST" style="display: none;">
            @csrf
            <button type="submit" class="btn btn-success mt-3">Confirmar importación</button>
        </form>
    </div>

    <script>
        document.getElementById('archivoExcel').addEventListener('change', function() {
            const formData = new FormData(document.getElementById('formPrevisualizarExcel'));

            fetch("{{ route('casos.preview') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    const container = document.getElementById('previewContainer');
                    container.innerHTML = ''; // Limpiar antes

                    const wrapper = document.createElement('div');
                    wrapper.classList.add('table-responsive');

                    const table = document.createElement('table');
                    table.classList.add('table', 'table-striped', 'table-hover', 'table-sm', 'align-middle',
                        'text-nowrap');

                    const thead = table.createTHead();
                    const rowHead = thead.insertRow();
                    data.columns.forEach(col => {
                        const th = document.createElement('th');
                        th.textContent = col;
                        th.classList.add('text-secondary', 'fw-bold', 'bg-light');
                        rowHead.appendChild(th);
                    });

                    const tbody = table.createTBody();
                    data.rows.forEach(row => {
                        const tr = tbody.insertRow();
                        row.forEach(cell => {
                            const td = tr.insertCell();
                            td.textContent = cell;
                        });
                    });

                    wrapper.appendChild(table);
                    container.appendChild(wrapper);
                    document.getElementById('formConfirmarImportacion').style.display = 'block';
                })

             
                .catch(err => {
                    alert('Error al previsualizar: ' + err.message);
                });
        });
    </script>
@endsection

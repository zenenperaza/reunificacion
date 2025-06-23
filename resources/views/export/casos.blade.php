<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>N° Caso</th>
            <th>Beneficiario</th>
            <th>Tipo Atención</th>
            <th>Fecha Atención</th>
            <th>Estado</th>
            <th>Municipio</th>
        </tr>
    </thead>
    <tbody>
        @foreach($casos as $caso)
            <tr>
                <td>{{ $caso->id }}</td>
                <td>{{ $caso->numero_caso }}</td>
                <td>{{ $caso->beneficiario }}</td>
                <td>{{ $caso->tipo_atencion }}</td>
                <td>{{ $caso->fecha_atencion }}</td>
                <td>{{ $caso->estado->nombre ?? '' }}</td>
                <td>{{ $caso->municipio->nombre ?? '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

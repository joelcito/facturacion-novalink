<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>NIT</th>
            <th>Estado</th>
            <th width="150">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($empresas as $empresa)
        <tr>
            <td>{{ $empresa->idempresas }}</td>
            <td>{{ $empresa->nombre }}</td>
            <td>{{ $empresa->nit }}</td>
            <td>{{ $empresa->estado }}</td>
            <td>
                <button class="btn btn-warning btn-sm"
                    onclick='editarEmpresa(@json($empresa))'>
                    Editar
                </button>

                <button class="btn btn-danger btn-sm"
                    onclick="eliminarEmpresa({{$empresa->idempresas }}, '{{ $empresa->nombre }}')">
                    Eliminar
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
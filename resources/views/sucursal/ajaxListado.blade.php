<table class="table table-bordered table-striped table-hover">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Empresa</th>
            <th>Nombre</th>
            <th>Código Sucursal</th>
            <th>Celular</th>
            <th>Municipio</th>
            <th>Estado</th>
            <th width="150">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sucursales as $sucursal)
            <tr>
                <td>{{ $sucursal->idsucursales }}</td>
                <td>{{ $sucursal->empresa->nombre ?? '' }}</td>
                <td>{{ $sucursal->nombre }}</td>
                <td>{{ $sucursal->codigo_sucursal }}</td>
                <td>{{ $sucursal->celular }}</td>
                <td>{{ $sucursal->municipio }}</td>
                <td>{{ $sucursal->estado }}</td>
                <td>
                    <button class="btn btn-warning btn-sm" 
                        onclick='editarSucursal(@json($sucursal))'>
                        Editar
                    </button>
                    <button class="btn btn-danger btn-sm" 
                        onclick="eliminarSucursal({{ $sucursal->idsucursales}}, '{{ $sucursal->nombre }}')">
                        Eliminar
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
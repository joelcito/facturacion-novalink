<table class="table table-bordered table-striped table-hover">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Tipo Plan</th>
            <th>Precio</th>
            <th>Facturas</th>
            <th>Sucursales</th>
            <th>Puntos de Venta</th>
            <th>Usuarios</th>
            <th>Productos</th>
            <th>Clientes</th>
            <th>Estado</th>
            <th width="150">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($planes as $plan)
        <tr>
            <td>{{ $plan->idplanes }}</td>
            <td>{{ $plan->nombre }}</td>
            <td>{{ $plan->tipo_plan }}</td>
            <td>{{ $plan->precio }}</td>
            <td>{{ $plan->cantidad_facturas }}</td>
            <td>{{ $plan->cantidad_sucursal }}</td>
            <td>{{ $plan->cantidad_punto_venta }}</td>
            <td>{{ $plan->cantidad_usuario }}</td>
            <td>{{ $plan->cantidad_producto }}</td>
            <td>{{ $plan->cantidad_cliente }}</td>
            <td>{{ $plan->estado }}</td>
            <td>
                <button class="btn btn-warning btn-sm" 
                    onclick='editarPlan(@json($plan))'>
                    Editar
                </button>
                <button class="btn btn-danger btn-sm" 
                    onclick="eliminarPlan({{$plan->idplanes}}, '{{ $plan->nombre }}')">
                    Eliminar
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
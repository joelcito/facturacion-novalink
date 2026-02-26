<table class="table table-bordered table-striped table-hover">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Empresa</th>
            <th>Plan</th>
            <th>Fecha Inicio</th>
            <th>Ampliación Facturas</th>
            <th>Fecha Fin</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th width="150">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($suscripciones as $suscripcion)
        <tr>
            <td>{{ $suscripcion->idsuscripciones }}</td>
            <td>{{ $suscripcion->empresa->nombre ?? '' }}</td>
            <td>{{ $suscripcion->plan->nombre ?? '' }}</td>
            <td>{{ $suscripcion->fecha_inicio }}</td>
            <td>{{ $suscripcion->ampliacion_cantidad_facturas }}</td>
            <td>{{ $suscripcion->fecha_fin }}</td>
            <td>{{ $suscripcion->descripcion }}</td>
            <td>{{ $suscripcion->estado }}</td>
            <td>
                <button class="btn btn-warning btn-sm" onclick='editarSuscripcion(@json($suscripcion))'>Editar</button>
                <button class="btn btn-danger btn-sm" onclick="eliminarSuscripcion({{ $suscripcion->idsuscripciones }}, '{{ $suscripcion->empresa->nombre ?? '' }}')">Eliminar</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
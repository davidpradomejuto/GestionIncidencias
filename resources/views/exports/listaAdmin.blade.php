<div>
    <table>
        @foreach ($incidencias as $incidencia)
            <tr>
                <td>{{ $incidencia->id }}</td>
                <td>{{ $incidencia->tipo }}</td>
                <td>{{ $incidencia->fecha_creacion }}</td>
                <td>{{ $incidencia->fecha_cierre }}</td>
                <td>{{ $incidencia->descripcion }}</td>
                <td>{{ $incidencia->estado }}</td>
                <td>{{ $incidencia->creador->nombre_completo }}</td>
                @if ($incidencia->responsable && $incidencia->responsable->nombre_completo)
                    <td>{{ $incidencia->responsable->nombre_completo }}</td>
                @else
                    <td>No asignado</td>
                @endif
                @if ($incidencia->duracion != null)
                    <td>{{ $incidencia->duracion }}</td>
                @else
                    <td>No acabado</td>
                @endif
                <td>{{ $incidencia->prioridad }}</td>
            </tr>
        @endforeach
    </table>
</div>

@extends('layouts.app')

@section('content')
<div>
    <h1>Calificaciones</h1>

    <form method="GET" action="">
        <div class="mb-4">
            <label>Selecciona grupo:</label>
            <select name="group_filter" onchange="this.form.submit()" class="border rounded w-full">
                <option value="">-- Selecciona grupo --</option>
                @foreach($groups as $gr)
                    <option value="{{ $gr->id }}" {{ $groupId == $gr->id ? 'selected' : '' }}>
                        {{ $gr->name }} | {{ $gr->schedule->course->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    @if($enrollments->count())
    <table class="table-auto border-collapse border border-gray-400 w-full mt-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Alumno</th>
                <th class="border px-4 py-2">Grupo</th>
                <th class="border px-4 py-2">Materia</th>
                <th class="border px-4 py-2">Calificación</th>
                <th class="border px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($enrollments as $enroll)
            <tr>
                <td class="border px-4 py-2">{{ $enroll->user->name }}</td>
                <td class="border px-4 py-2">{{ $enroll->group->name }}</td>
                <td class="border px-4 py-2">{{ $enroll->group->schedule->course->name }}</td>
                <td class="border px-4 py-2">
                    @if($enroll->grade)
                        {{ $enroll->grade->grade }}
                    @else
                        N/A
                    @endif
                </td>
                <td class="border px-4 py-2">
                    @if($enroll->grade)
                        <a href="{{ route('edit.calificacion', $enroll->grade->id) }}" class="text-blue-500 hover:text-blue-700">Editar</a>
                        <form action="{{ route('delete.calificacion', $enroll->grade->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Eliminar</button>
                        </form>
                    @else
                        <form action="{{ route('save.calificacion') }}" method="POST">
                            @csrf
                            <input type="hidden" name="enrollment_id" value="{{ $enroll->id }}">
                            <input type="number" name="grade" min="0" max="100" step="0.1" class="border rounded w-20">
                            <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">Guardar</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>Selecciona un grupo para ver los alumnos inscritos.</p>
    @endif
</div>
@endsection
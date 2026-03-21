@extends('layouts.app')
@section('content')
    <div>
        <div>
            <h1>Inscripciones</h1>
            <form method="GET" action="">
                <div class="mb-4">
                    <label for="schedule" class="block text-gray-700 font-bold mb-2">Selecciona grupo:</label>
                    <select name="group_filter" class="border rounded w-full" onchange="this.form.submit()" required>
                        <option value="">-- Selecciona grupo --</option>
                        @foreach($groups as $gr)
                            <option value="{{ $gr->id }}" 
                                {{ $groupId == $gr->id ? 'selected' : '' }}>
                                {{ $gr->name }} | {{ $gr->schedule->course->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
            <form action="{{ route('save.inscripcion') }}" method="post">
                @csrf
                <input type="hidden" name="group_id" value="{{ $groupId }}">

                <div class="mb-4">
                    <label>Alumnos disponibles:</label>
                    <select name="user_id" class="border rounded w-full" required>
                        @forelse($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->institutional_key }} | {{ $user->name }}
                            </option>
                        @empty
                            <option disabled>No hay alumnos disponibles</option>
                        @endforelse
                    </select>
                </div>

                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                    Inscribir alumno
                </button>
            </form>
        </div>

        <div>
            <form method="GET" action="">
                <select name="group_filter" onchange="this.form.submit()">
                    <option value="">-- Selecciona grupo --</option>
                    @foreach($groups as $gr)
                        <option value="{{ $gr->id }}" 
                            {{ $groupId == $gr->id ? 'selected' : '' }}>
                            {{ $gr->name }} | {{ $gr->schedule->course->name }}
                        </option>
                    @endforeach
                </select>
            </form>
            <table class="table-auto border-collapse border border-gray-400 w-full">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">Clave del alumno</th>
                        <th class="border px-4 py-2">Nombre del alumno</th>
                        <th class="border px-4 py-2">Nombre del Grupo</th>
                        <th class="border px-4 py-2">Materia</th>
                        <th class="border px-4 py-2">Profesor</th>
                        <th class="border px-4 py-2">Hora inicio</th>
                        <th class="border px-4 py-2">Hora fin</th>
                        <th class="border px-4 py-2">Días</th>
                        <th class="border px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($enrollments as $enroll)
                    <tr>
                        <td class="border px-4 py-2">{{ $enroll->user->institutional_key }}</td>
                        <td class="border px-4 py-2">{{ $enroll->user->name }}</td>
                        <td class="border px-4 py-2">{{ $enroll->group->name }}</td>
                        <td class="border px-4 py-2">{{ $enroll->group->schedule->course->name }}</td>
                        <td class="border px-4 py-2">{{ $enroll->group->schedule->teacher->name }}</td>
                        <td class="border px-4 py-2">{{ $enroll->group->schedule->start_time }}</td>
                        <td class="border px-4 py-2">{{ $enroll->group->schedule->end_time }}</td>
                        <td class="border px-4 py-2">{{ $enroll->group->schedule->days }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('edit.inscripcion', $enroll->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">Editar</a>
                            <form action="{{ route('delete.inscripcion', $enroll->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Eliminar inscripcion?')" class="text-red-500 hover:text-red-700">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
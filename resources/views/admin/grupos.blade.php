@extends('layouts.app')
@section('content')
    <div>
        <div>
            <h1>Grupos</h1>
            <form action="{{ route('save.grupo') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Nombre del grupo:</label>
                    <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full">
                </div>
                <div class="mb-4">
                    <label for="schedule" class="block text-gray-700 font-bold mb-2">Horario:</label>
                    <select name="scheduleId" class="border rounded w-full">
                        @foreach($schedules as $hr)
                            <option value="{{ $hr->id }}">
                                {{ $hr->course->name }} | {{ $hr->teacher->name }} | {{ $hr->start_time }} - {{ $hr->end_time }} | {{ $hr->days }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                    Agregar Grupo
                </button>
            </form>
        </div>

        <div>
            <table class="table-auto border-collapse border border-gray-400 w-full">
                <thead>
                    <tr class="bg-gray-200">
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
                    @foreach($groups as $gr)
                    <tr>
                        <td class="border px-4 py-2">{{ $gr->name }}</td>
                        <td class="border px-4 py-2">{{ $gr->schedule->course->name }}</td>
                        <td class="border px-4 py-2">{{ $gr->schedule->teacher->name }}</td>
                        <td class="border px-4 py-2">{{ $gr->schedule->start_time }}</td>
                        <td class="border px-4 py-2">{{ $gr->schedule->end_time }}</td>
                        <td class="border px-4 py-2">{{ $gr->schedule->days }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('edit.grupo', $gr->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">Editar</a>
                            <form action="{{ route('delete.grupo', $gr->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Eliminar grupo?')" class="text-red-500 hover:text-red-700">
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
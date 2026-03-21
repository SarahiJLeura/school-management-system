@extends('layouts.app')
@section('content')
    <div>
        <div>
            <h1>Horarios</h1>
            <form action="{{ route('save.horario') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="course" class="block text-gray-700 font-bold mb-2">Materia:</label>
                    <select name="courseId" class="border rounded w-full">
                        @foreach($courses as $course)

                        <option value="{{ $course->id }}">
                            {{ $course->name }}
                        </option>

                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="teacher" class="block text-gray-700 font-bold mb-2">Profesor:</label>
                    <select name="teacherId" class="border rounded w-full">
                        @foreach($teachers as $teacher)

                        <option value="{{ $teacher->id }}">
                            {{ $teacher->name }}
                        </option>

                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="startTime" class="block text-gray-700 font-bold mb-2">Hora inicio:</label>
                    <input type="time" name="startTime" class="border rounded w-full">
                </div>
                <div class="mb-4">
                    <label for="endTime" class="block text-gray-700 font-bold mb-2">Hora fin:</label>
                    <input type="time" name="endTime" class="border rounded w-full">
                </div>
                <div class="mb-4">
                    <label for="days" class="block text-gray-700 font-bold mb-2">Días:</label>
                    <label>
                        <input type="checkbox" name="days[]" value="Mon"> Lunes
                    </label>
                    <label>
                        <input type="checkbox" name="days[]" value="Tue"> Martes
                    </label>
                    <label>
                        <input type="checkbox" name="days[]" value="Wed"> Miércoles
                    </label>
                    <label>
                        <input type="checkbox" name="days[]" value="Thur"> Jueves
                    </label>
                    <label>
                        <input type="checkbox" name="days[]" value="Fri"> Viernes
                    </label>
                    <label>
                        <input type="checkbox" name="days[]" value="Sat"> Sábado
                    </label>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                    Agregar Horario
                </button>
            </form>
        </div>

        <div>
            <table class="table-auto border-collapse border border-gray-400 w-full">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">Materia</th>
                        <th class="border px-4 py-2">Profesor</th>
                        <th class="border px-4 py-2">Hora inicio</th>
                        <th class="border px-4 py-2">Hora fin</th>
                        <th class="border px-4 py-2">Días</th>
                        <th class="border px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($horarios as $hr)
                        <tr>
                            <td class="border px-4 py-2">{{ $hr->course->name }}</td>
                            <td class="border px-4 py-2">{{ $hr->teacher->name }}</td>
                            <td class="border px-4 py-2">{{ $hr->start_time }}</td>
                            <td class="border px-4 py-2">{{ $hr->end_time }}</td>
                            <td class="border px-4 py-2">{{ $hr->days }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('edit.horario', $hr->id) }}" class="text-blue-500 hover:text-blue-700">
                                    Editar
                                </a>
                                <form action="{{ route('delete.horario', $hr->id) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" 
                                    onclick="return confirm('¿Eliminar horario?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@extends('layouts.app')
@section('content')
    <div>
        <div>
            <form action="{{ route('update.horario', $horario->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="course" class="block text-gray-700 font-bold mb-2">Materia:</label>
                    <select name="courseId" class="border rounded w-full">
                        @foreach($courses as $course)

                        <option value="{{ $course->id }}" {{ $horario->course_id == $course->id ? 'selected' : '' }}>
                            {{ $course->name }}
                        </option>

                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="teacher" class="block text-gray-700 font-bold mb-2">Profesor:</label>
                    <select name="teacherId" class="border rounded w-full">
                        @foreach($teachers as $teacher)

                        <option value="{{ $teacher->id }}" {{ $horario->teacher_id == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->name }}
                        </option>

                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="startTime" class="block text-gray-700 font-bold mb-2">Hora inicio:</label>
                    <input type="time" name="startTime" class="border rounded w-full" value="{{ $horario->start_time }}">
                </div>
                <div class="mb-4">
                    <label for="endTime" class="block text-gray-700 font-bold mb-2">Hora fin:</label>
                    <input type="time" name="endTime" class="border rounded w-full" value="{{ $horario->end_time }}">
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
                <a href="/horarios" class="bg-red-500 text-white font-bold py-2 px-4 rounded mt-4">
                    Cancelar
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                    Guardar cambios
                </button>
            </form>
        </div>
    </div>
@endsection
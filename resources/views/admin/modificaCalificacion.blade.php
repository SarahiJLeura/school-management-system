@extends('layouts.app')

@section('content')
<div>
    <h1>Modificar Calificación</h1>

    <form action="{{ route('update.calificacion', $gradeEdit->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label>Grupo:</label>
            <select name="group_id" class="border rounded w-full">
                @foreach($groups as $gr)
                    <option value="{{ $gr->id }}"
                        {{ $gr->id == $gradeEdit->enrollment->group_id ? 'selected' : '' }}>
                        
                        {{ $gr->name }} | 
                        {{ $gr->schedule->course->name }} | 
                        {{ $gr->schedule->teacher->name }} | 
                        {{ $gr->schedule->start_time }} - {{ $gr->schedule->end_time }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label>Alumno:</label>
            <select name="user_id" class="border rounded w-full">
                <option value="{{ $gradeEdit->enrollment->user->id }}" selected>
                    {{ $gradeEdit->enrollment->user->institutional_key }} | 
                    {{ $gradeEdit->enrollment->user->name }}
                </option>
            </select>
        </div>

        <div class="mb-4">
            <label>Calificación:</label>
            <input type="number" name="grade" min="0" max="100" step="0.1"
                   value="{{ $gradeEdit->grade }}" class="border rounded w-32">
        </div>

        <a href="{{ route('index.calificaciones') }}" class="bg-red-500 text-white px-4 py-2 rounded">
            Cancelar
        </a>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Guardar cambios
        </button>
    </form>
</div>
@endsection
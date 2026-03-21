@extends('layouts.app')

@section('content')
<div>
    <h1>Editar Inscripción</h1>

    <form action="{{ route('update.inscripcion', $enrollEdit->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label>Grupo:</label>
            <select name="group_id" class="border rounded w-full">
                @foreach($groups as $gr)
                    <option value="{{ $gr->id }}"
                        {{ $gr->id == $enrollEdit->group_id ? 'selected' : '' }}>
                        
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
                @foreach($users as $user)
                    <option value="{{ $user->id }}"
                        {{ $user->id == $enrollEdit->user_id ? 'selected' : '' }}>
                        
                        {{ $user->institutional_key }} | {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <a href="/inscripciones" class="bg-red-500 text-white px-4 py-2 rounded">
            Cancelar
        </a>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Guardar cambios
        </button>
    </form>
</div>
@endsection
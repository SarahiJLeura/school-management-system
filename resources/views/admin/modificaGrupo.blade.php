@extends('layouts.app')
@section('content')
    <div>
        <div>
            <h1>Grupos</h1>
            <form action="{{ route('update.grupo', $grupo->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Nombre del grupo:</label>
                    <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full" value="{{ $grupo->name }}">
                </div>
                <div class="mb-4">
                    <label for="schedule" class="block text-gray-700 font-bold mb-2">Horario:</label>
                    <select name="scheduleId" class="border rounded w-full">
                        @foreach($schedules as $hr)
                            <option value="{{ $hr->id }}" {{ $grupo->schedule_id == $hr->id ? 'selected' : '' }} >
                                {{ $hr->course->name }} | {{ $hr->teacher->name }} | {{ $hr->start_time }} - {{ $hr->end_time }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <a href="/grupos" class="bg-red-500 text-white font-bold py-2 px-4 rounded mt-4">
                    Cancelar
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                    Guardar cambios
                </button>
            </form>
        </div>
    </div>
@endsection
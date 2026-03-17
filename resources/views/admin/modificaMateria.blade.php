@extends('layouts.app')
@section('content')
    <div>
        <div>
            <form action="{{ route('update.materia', $materia->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Nombre de la materia:</label>
                    <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full" value="{{ $materia->name }}">
                </div>
                <div class="mb-4">
                    <label for="code" class="block text-gray-700 font-bold mb-2">Código de la materia:</label>
                    <input type="text" name="code" id="code" class="shadow appearance-none border rounded w-full" value="{{ $materia->code }}">
                </div>
                <a href="/materias" class="bg-red-500 text-white font-bold py-2 px-4 rounded mt-4">
                    Cancelar
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                    Guardar cambios
                </button>
            </form>
        </div>
    </div>
@endsection
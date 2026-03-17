@extends('layouts.app')
@section('content')
    <div>
        <div>
            <h1>Materias</h1>
            <form action="{{ route('save.materia') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Nombre de la materia:</label>
                    <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full">
                </div>
                <div class="mb-4">
                    <label for="code" class="block text-gray-700 font-bold mb-2">Código de la materia:</label>
                    <input type="text" name="code" id="code" class="shadow appearance-none border rounded w-full">
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                    Agregar Materia
                </button>
            </form>
        </div>

        <div>
            <table class="table-auto border-collapse border border-gray-400 w-full">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">Nombre</th>
                        <th class="border px-4 py-2">Código</th>
                        <th class="border px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materias as $mat)
                        <tr>
                            <td class="border px-4 py-2">{{ $mat->name }}</td>
                            <td class="border px-4 py-2">{{ $mat->code }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('edit.materia', $mat->id) }}" class="text-blue-500 hover:text-blue-700">
                                    Editar
                                </a>
                                <form action="{{ route('delete.materia', $mat->id) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" 
                                    onclick="return confirm('¿Eliminar materia?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
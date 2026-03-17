@extends('layouts.app')
@section('content')
    <div>
        <div>
            <form action="{{ route('save.login') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="user_key" class="block text-gray-700 font-bold mb-2">Clave institucional:</label>
                    <input type="text" name="user_key" id="user_key" class="shadow appearance-none border rounded w-full" required>
                </div>
                <div class="mb-4">
                    <label for="pass" class="block text-gray-700 font-bold mb-2">Contraseña:</label>
                    <input type="password" name="pass" id="pass" class="shadow appearance-none border rounded w-full" required>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                    Log in
                </button>
            </form>
        </div>
    </div>
@endsection
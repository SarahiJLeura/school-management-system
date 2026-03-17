<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function indexLogin(){
        return view('auth.login');
    }

    public function indexRegister(){
        return view('auth.register');
    }

    public function saveLogin(Request $request){
        $request->validate([
            'user_key' => 'required',
            'pass' => 'required'
        ]);
        $user = User::where('institutional_key', $request->user_key)->first();

        if (!$user || !Hash::check($request->pass, $user->password)) {
            return back()->withErrors([
                'login' => 'Credenciales incorrectas'
            ]);
        }

        if(!$user->is_activate){
            return back()->withErrors([
                'login' => 'Usuario desactivado'
            ]);
        }

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('index.admin');
    }

    public function saveRegister(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'user_key' => 'required|string|unique:users,institutional_key',
            'pass' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'institutional_key' => $request->user_key,
            'password' => Hash::make($request->pass),
            'role' => 'student'
        ]);

        return redirect()->route('index.login')->with('success','Usuario registrado');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index.login');
    }
}

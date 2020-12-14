<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create() {

        return view('User.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required | min:3 | max:30',
            'email' => 'required|email|unique:users',
            'password' => 'required | min:4 | max:16 | confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);
        return redirect()->home()->with('success', 'Регистрация успешна');
    }

    public function loginForm() {
        return view('User.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])){
            session()->flash('success', 'Авторизация успешна');
            //Если админ - админпанель, юзер - на главную
            return redirect()->route(Auth::user()->is_admin ?  'admin.index' : 'home');
        }
        return redirect()->back()->with('error', 'Почта или пароль не совпадают');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login.form')->with('succsecc', 'Вы вышли из системы');
    }
}

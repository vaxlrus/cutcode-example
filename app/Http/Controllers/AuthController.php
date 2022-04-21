<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view("auth.login");
    }

    public function showRegisterForm()
    {
        return view("auth.register");
    }

    public function login(Request $request)
    {
        // Масссив с валидированными данными
        $data = $request->validate([
            "email" => ["required", "email", "string", "exists:users,email"],
            "password" => ["required"]
        ]);

        // Попытаться выполнить аутентификацию
        if (auth("web")->attempt($data))
        {
            return redirect(route("home"));
        }

        return redirect(route("login"))->withErrors(["email" => "Пользователь не найден, либо введены не верные данные"]);
    }

    public function logout()
    {
        auth("web")->logout();

        return redirect(route("home"));
    }

    public function register(Request $request)
    {
        // Масссив с валидированными данными
        $data = $request->validate([
            "name" => ["required", "string"],
            "email" => ["required", "email", "string", "unique:users,email"],
            "password" => ["required", "confirmed"]
        ]);

        // Создать нового пользователя и получить модель юзера
        $user = User::create([
            "name" => $data['name'],
            "email" => $data['email'],
            "password" => bcrypt($data['password'])
        ]);

        if ($user)
        {
            auth("web")->login($user);
        }

        return redirect(route("home"));
    }
}

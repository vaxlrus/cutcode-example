<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuthForm;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view("admin.auth.login");
    }

    public function login(AdminAuthForm $request)
    {
        // Масссив с валидированными данными
        $data = $request->validated();

        // Попытаться выполнить аутентификацию
        if (auth("admin")->attempt($data))
        {
            return redirect(route("admin.posts.index"));
        }

        return redirect(route("admin.login"))->withErrors([
            "email" => "Пользователь не найден, либо введены не верные данные"
        ]);
    }

    public function logout()
    {
        auth("admin")->logout();

        return view("home");
    }
}

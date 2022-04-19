<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class IndexController extends Controller
{
    public function index()
    {
        // Получить 3 последних поста
        $posts = Post::query()->orderBy("created_at", "DESC")->limit(3)->get();

        return view('welcome', [
            // Передать коллекцию из моделей
            "posts" => $posts
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentForm;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->paginate(3);

        return view('posts.index', [
            "posts" => $posts
        ]);
    }

    public function show(int $id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Добавление нового комментария к посту
     *
     * @param int $id ИД поста
     * @param CommentForm $request
     */
    public function comment(int $id, CommentForm $request)
    {
        $post = Post::findOrFail($id);

        $post->comments()->create($request->validated());

        return redirect(route("posts.show", $id));
    }
}

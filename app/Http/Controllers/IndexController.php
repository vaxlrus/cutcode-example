<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactForm;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;

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

    public function showContactForm()
    {
        return view('emails.contact_form');
    }

    public function contactFormHandler(ContactFormRequest $request)
    {
        Mail::to("vaxl.rus@gmail.com")->send(new ContactForm($request->validated()));

        return redirect(route('contacts'));
    }
}

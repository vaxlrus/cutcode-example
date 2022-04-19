{{-- Наследование от стандартного layout --}}
@extends('layout.app')

{{-- Наименование страницы --}}
@section('title', 'Главная страница')

{{-- Отображение контента --}}
@section('content')

    {{-- Подключение шапки --}}
    @include('partials.header')

    {{-- Отображение новостей на главной --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-10 mb-20">
        @foreach($posts as $post)
            @include("posts.partials.item", ["post" => $post])
        @endforeach
    </div>

@endsection

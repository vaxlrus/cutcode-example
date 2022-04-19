{{-- Наследование от стандартного layout --}}
@extends('layout.app')

{{-- Наименование страницы --}}
@section('title', 'Статьи')

{{-- Отображение контента --}}
@section('content')

    {{-- Подключение шапки --}}
    @include('partials.header')

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-10 mb-20">

        {{-- Простой вариант подключения шаблона --}}
{{--        @foreach($posts as $post)--}}
{{--            @include("posts.partials.item")--}}
{{--        @endforeach--}}

        {{-- Более элегантный вариант подключения шаблона --}}
        @each('posts.partials.item', $posts, 'post')

        {{-- Отображение кнопок пагинации --}}
        {{ $posts->links() }}
    </div>

@endsection

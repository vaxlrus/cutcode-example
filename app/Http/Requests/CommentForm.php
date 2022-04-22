<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // К комментированию будут допущены только аутентифицированные пользователи
        return auth("web")->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "text" => ["required", "string", "min:5"],
            "user_id" => ["required", "exists:users,id"]
        ];
    }

    /**
     * Метод выполняется до валидации
     * Почему нужно все это? Чтобы в форме на странице в hidden input не добавлять id пользователя и не светить всем
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // Добавить к текущему запросу данные
        $this->merge([
            // Добавить ID текущего пользователя
            "user_id" => auth("web")->id()
        ]);
    }
}

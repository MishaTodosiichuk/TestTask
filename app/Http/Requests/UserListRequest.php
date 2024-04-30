<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:50',
            'phones.*' => 'required|max:20|min:10|unique:user_lists, phone_num',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Це поле обовʼязкове для заповнення",
            'name.max' => "Це поле може містити до 50 символів",
            'phones.*.required' => "Це поле обовʼязкове для заповнення",
            'phones.*.max' => "Це поле може містити до 20 символів",
            'phones.*.min' => "Це поле може містити принаймні 10 символів",
            'phones.*.unique' => "Це поле повинне бути унікальним",
        ];
    }
}

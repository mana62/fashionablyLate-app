<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'tell' => 'required|digits_between:1,11',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '※お名前を入力してください',
            'name.string' => '※お名前は文字形式で記入してください',
            'name.max' => '※お名前は255文字以下で記入してください',
            'email.required' => '※メールアドレスを入力してください',
            'email.string' => '※メールアドレスは文字形式で入力してください',
            'email.email' => '※メールアドレスはアドレス形式で入力してください',
            'email.max' => '※メールアドレスは255文字以下で入力してください',
            'tell.required' => '※電話番号を入力してください',
            'tell.digits_between' => '※電話番号は1から11桁の数字で入力してください',

        ];
    }
}

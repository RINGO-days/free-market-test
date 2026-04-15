<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'image' => 'required|mimes:jpg,jpeg,png',
            'name' => 'required|max:20',
            'post_code' => ['required','regex:/^\d{3}-\d{4}$/','max:8'],
            'address' => 'required',
            'building' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'image.required' => '画像を選択してください',
            'image.mimes' => '画像形式は.jpg形式もしくは.png形式を選択してください',
            'name.required' => '名前を入力してください',
            'name.max' => '名前は20文字以内で入力してください',
            'post_code.required' => '郵便番号を入力してください',
            'post_code.regex' => '郵便番号は000-0000の形式で入力してください',
            'post_code.max' => '郵便番号は8文字以内で入力してください',
            'address.required' => '住所を入力してください'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressSearchRequest extends FormRequest
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
            'post_code' => ['required','regex:/^\d{3}-\d{4}$/']
        ];
    }

    public function messages(){
        return [
            'post_code.required' => '住所を検索するには、郵便番号を入力してください',
            'post_code.regex' => '郵便番号は半角数字で000-0000の形式で入力してください'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
            'image' => 'required|mimes:jpeg,jpg,png',
            'category' => 'required|array',
            'condition_id' => 'required',
            'name' => 'required',
            'brand' => 'nullable',
            'description' => 'required|max:225',
            'price' => 'required|integer|min:1'
        ];
    }

    public function messages()
    {
        return [
            'image.required' => '商品画像をアップロードしてください',
            'image.mimes' => '画像形式は.jpg形式もしくは.png形式を選択してください',
            'category.required' => '商品カテゴリを選択してください',
            'condition_id.required' => '商品の状態を選択してください',
            'name.required' => '商品名を入力してください',
            'description.required' => '商品の説明を記載してください',
            'description.max' => '商品の説明は最大225文字以内で記載してください',
            'price.required' => '商品の価格を入力してください',
            'price.integer' => '商品の価格は整数で入力してください',
            'price.min' => '商品の価格は1円以上を入力してください'
        ];
    }
}

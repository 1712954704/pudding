<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TableRequest extends FormRequest
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
            'title'             =>       'required|max:125',
            'num'               =>       'required|digits_between:1,6',
            'detail'            =>       'nullable|max:255',
        ];
    }

    public function messages(){
        return [
            'title.required' => '名称不能为空',
            'title.max'      => '名称不能超过125字符',
            'num.required'   => '人数不能为空',
            'num.digits_between'     => '人数必须为数字,位数要在1-6之间',
            'detail.max'     => '描述不能超过255字符',
        ];
    }
}

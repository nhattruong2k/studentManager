<?php

namespace App\Http\Requests\Courst;

use Illuminate\Foundation\Http\FormRequest;

class CourstRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'ten_khoa_hoc' => 'required',
            // 'start_date' => 'required',
            // 'end_date' => 'required',
        ];
    }


    // public function messages()
    // {
    //     return [
    //         'ten_khoa_hoc.required' => 'Chưa nhập tên khóa học',
    //         'start_date.required' => 'Chưa nhập ngày bắt đầu',
    //         'end_date.required' => 'Chưa nhập ngày kết thúc',
    //     ];
    // }
}

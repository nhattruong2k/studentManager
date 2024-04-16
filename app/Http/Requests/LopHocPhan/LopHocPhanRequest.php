<?php

namespace App\Http\Requests\LopHocPhan;

use Illuminate\Foundation\Http\FormRequest;

class LopHocPhanRequest extends FormRequest
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
            'Ten_hp' => 'required|min:3|max:150|unique:lop_hoc_phans,Ten_hp,'.$this->id. ',id,deleted_at,NULL',
        ];
    }

    public function messages()
    {
        return [
            'Ten_hp.required' => trans('lophocphan.validation.name_empty'),
            'Ten_hp.min' => trans('lophocphan.validation.name_min', ['amount' => 3]),
            'Ten_hp.max' => trans('lophocphan.validation.name_max', ['amount' => 150]),
            'Ten_hp.unique' => trans('lophocphan.validation.name_exist'),
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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

            'Name_Section_Ar' => 'required',
            'Name_Section_En' => 'required',
            'grade_id' => 'required',
            'class_id' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'Name_Section_Ar.required' => trans('Section_trans.required_ar'),
            'Name_Section_En.required' => trans('Section_trans.required_en'),
            'grade_id.required' => trans('Section_trans.grade_id_required'),
            'class_id.required' => trans('Section_trans.class_id_required'),
        ];
    }
}

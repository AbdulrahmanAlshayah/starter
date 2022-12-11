<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //اذا ما حطيتا هون true لح يعطيك هاد الخطأ
        //403 THIS ACTION IS UNAUTHORIZED.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'name_ar' => 'required|max:100|unique:ofers,name_ar',
            'name_en' => 'required|max:100|unique:ofers,name_en',
            'price' => 'required|numeric',
            'details_ar' => 'required',
            'details_en' => 'required',
        ];
    }

    public function messages(){
        return $messages = [
            //'name.required' => trans('offernamerequired') or trans('offer name required'),
            'name.required' => __('messages.offer name required'),
            'name.unique' => __('messages.offer name must be unique'),
            'price.numeric' => 'سعر العرض يجب أن يكون أرقام',
            'price.required' => trans('messages.pricerequired'),
            'details.required' => 'التفاصيل مطلوبة',
        ];
    }
}

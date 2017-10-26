<?php

namespace Webelightdev\LaravelSlider\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSliderRequest extends FormRequest
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
            'title' => 'required',
            'slider_type' => 'required',
            'is_active' => 'required',
            'auto_paly' => 'required',
            'slides_to_show' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ];
    }
}

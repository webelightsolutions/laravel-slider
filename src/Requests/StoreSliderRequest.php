<?php

namespace Webelightdev\LaravelSlider\src\Requests;

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
            'name' => 'required',
            'slider_type' => 'required',
            'is_active' => 'required',
            'auto_paly' => 'required',
            'slides_per_page' => 'required',
            'slider_width' => 'required',
            'slider_height' => 'required'
        ];
    }
}

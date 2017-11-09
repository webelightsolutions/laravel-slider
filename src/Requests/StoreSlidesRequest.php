<?php

namespace Webelightdev\LaravelSlider\src\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSlidesRequest extends FormRequest
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
            'slider_id' => 'required',
            'title' => 'required',
            'is_active' => 'required',
            'caption' => 'required',
            'description' => 'required',
            'image_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ];
    }
}

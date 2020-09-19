<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabRequest extends FormRequest
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
    protected $redirectRoute='labs.create';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fasting_blood_sugar'=>'required',
            'hba1c'=>'required',
            'bun'=>'required',
            'creatinine'=>'required',
            
        ];

    
    
    }
}

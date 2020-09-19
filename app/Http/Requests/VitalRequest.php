<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VitalRequest extends FormRequest
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
    protected $redirectRoute='vitals.create';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'weight'=>['required','min:1','numeric'],
            'height'=>['required','min:1','numeric'],
            'abdominal_girth'=>['required','numeric'],
            'systolic_bp'=>['required','numeric'],
            'diastolic_bp'=>['required','numeric'],
            'heart_rate'=>['required','numeric'],
            
            
        ];
    }
    /*
    public function messages()
    {
        return[
            

         
        ];
    }
    */
  
}

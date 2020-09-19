<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
            'name'=>'required',
            'name'=>'unique:patients',
            'gender'=>'required',
            'birth_date'=>'required',
            'area_of_residence'=>'required',
            'mobile_phone_number'=>'required|unique:patients|',
         
         //   'alternative_phone_number'=>['required','size:10','integer']
        ];
    }
    public function messages()
    {
        return[
            'name.required'=>'Please enter a Full Name',
            'gender.required'=>"Please enter a the patients Sex",
            'birth_date.required'=>"Please enter a valid date of birth",
            'area_of_residence.required'=>"Please enter the patients home address",
            'mobile_phone_number.size'=>"The phone number must be 10 digits long",
            'mobile_phone_number.required'=>"Please enter the patients mobile number",
         

         
        ];
    }
}

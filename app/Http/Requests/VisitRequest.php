<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitRequest extends FormRequest
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
    protected $redirectRoute='visits.create';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'has_history_of_high_bp?'=>'required',
            'has_history_of_diabetes?'=>'required',
            'has_heart_disease?'=>'required',
            'has_history_of_stroke?'=>'required',
            'smokes?'=>'required',
            // 'takes_ASA?'=>'required',
            // 'takes_BB?'=>'required',
            // 'takes_CCB?'=>'required',
            // 'takes_Diuretic?'=>'required',
            // 'takes_ARB?'=>'required',
            // 'takes_ACE_I?'=>'required',
            // 'has_history_of_stroke?'=>'required',
            // 'takes_insulin/OHA?'=>'required',


        ];
    }
    public function messages()
    {
        return[
            'has_history_of_high_bp?.required'=>'Is the patient hypertensive',
            'has_history_of_diabetes?.required'=>"Does the patient have diabetes",
            'has_heart_disease?.required'=>"Does the patient have a history of heart disease",
            'has_history_of_stroke?.required'=>"Has the patient ever had a stroke",
            'smokes?.required'=>"Does the patient smoke?",
            // 'takes_BB?.required'=>"Does the patient take BB?",
            // 'takes_CCB?.required'=>"Does the patient take CCB?",
            // 'takes_Diuretic?.required'=>"Does the patient use Diuretic medicine?",
            // 'takes_ARB?.required'=>"Does the patient take ARB?",
            // 'takes_ACE_I?.required'=>"Does the patient take ACE_I?",
            // 'takes_ASA?.required'=>"Does the patient take ASA?",
            // 'takes_insulin/OHA?.required'=>"Does the patient take takes_insulin/OHA?",


         
        ];
    }

}

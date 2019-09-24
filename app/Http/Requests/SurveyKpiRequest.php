<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurveyKpiRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
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
            'kpi_name'=>'required',
            'survey_form'=>'required',
            'user_data' => 'required',
        ];
    } 
    public function messages()
    {
        return[
            'user_data.required' => 'The user name field is required',
        ];
    }

    
    

}

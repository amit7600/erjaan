<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurveyFormInfoRequest extends FormRequest {

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
                'survey_form_title' => 'required',
                'survey_form_header' => 'required',
                'survey_form_footer' => 'required',
                'survey_question.*' => 'required',
                'question_type.*' => 'required',
                //'survey_option_title_1.*' => 'required',
                //'option_point_1.*' => 'required'
                
            ];
       

    }

    public function messages()
    {    

            return [
                'survey_form_title.required' => 'Please enter form title',
                'survey_form_header.required' => 'Please enter form header',
                'survey_form_footer.required' => 'Please enter form footer',
                'survey_question.*.required' => 'Please enter survey question',
                'question_type.*.required' => 'Please select survey question type',
                'survey_option_title_1.*.required' => 'Please enter option title',
                'option_point.*.required' => 'Please enter option point'

            ];
            
    }


    
    

}

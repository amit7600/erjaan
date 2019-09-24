<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurveyFormRequest extends FormRequest {

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
        $form_action = "";
        if(!empty($_POST['form_action'])){
            $form_action = $_POST['form_action'];
        }

        if($form_action=='update_form'){
            return [
                'form_language_type' => 'required', 
                'survey_form_title' => 'required',
                'survey_form_header' => 'required',
                'survey_form_footer' => 'required',
                'survey_question.*' => 'required',
                'question_type.*' => 'required',
                //'survey_option_title_1.*' => 'required',
                //'option_point_1.*' => 'required'
                
            ];
        }else{
           return [
                'form_language_type' => 'required',
                'survey_form_title' => 'required',
                'survey_form_header' => 'required',
                'survey_form_footer' => 'required',
                'survey_form_logo' => 'required|mimes:jpeg,png,jpg,gif|max:20480',
                'survey_question.*' => 'required',
                'question_type.*' => 'required',
                //'survey_option_title_1.*' => 'required',
                //'option_point.*' => 'required' @Commented temprory 
                
            ]; 
        }

    }

    public function messages()
    {    

        $form_action = "";
        if(!empty($_POST['form_action'])){
            $form_action = $_POST['form_action'];
        }

        if($form_action=='update_form'){
            return [
                'form_language_type.required' => 'Please select form language',
                'survey_form_title.required' => 'Please enter form title',
                'survey_form_header.required' => 'Please enter form header',
                'survey_form_footer.required' => 'Please enter form footer',
                'survey_question.*.required' => 'Please enter survey question',
                'question_type.*.required' => 'Please select survey question type',
                'survey_option_title_1.*.required' => 'Please enter option title',
                'option_point.*.required' => 'Please enter option point'

            ];
            
        }else{
            return [
                'form_language_type.required' => 'Please select form language',
                'survey_form_title.required' => 'Please enter form title',
                'survey_form_header.required' => 'Please enter form header',
                'survey_form_footer.required' => 'Please enter form footer',
                'survey_form_logo.required' => 'Please select form logo',
                'survey_question.*.required' => 'Please enter survey question',
                'question_type.*.required' => 'Please select survey question type',
                'survey_option_title_1.*.required' => 'Please enter option title',
                'option_point.*.required' => 'Please enter option point'

            ];
        }  
    }


    
    

}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurveyQuestionRequest extends FormRequest {

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
        $arr = array(
            'survey_form_id' => 'required',
            'question_type' => 'required',
            'survey_question' => 'required'
        );
        
        switch ($this->method()) {
            case 'PUT':
                $id = $this->segment(3);
                $arr['survey_form_id'] = "required";
                $arr['question_type'] = "required";
                $arr['survey_question'] = "required";
                break;
        }     
        
        return $arr;
    }
    
    

}

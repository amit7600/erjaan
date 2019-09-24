<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurveyOptionRequest extends FormRequest {

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
            'survey_question_id' => 'required',
            'survey_option_title' => 'required',
            'option_point' => 'required'
        );
        
        switch ($this->method()) {
            case 'PUT':
                $id = $this->segment(3);
                $arr['survey_question_id'] = "required";
                $arr['survey_option_title'] = "required";
                $arr['option_point'] = "required";
                break;
        }     
        
        return $arr;
    }
    
    

}

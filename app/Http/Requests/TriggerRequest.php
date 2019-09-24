<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class TriggerRequest extends FormRequest {

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
    
    
    public function rules(Request $request)
    { 
        if($_POST['form_action']=='update_form'){
            return [
                'trigger_name' => 'required',
                'waiting_time' => $request->get('immediately') ? '' : 'required',
                'waiting_time_formate' => 'required',
                'trigger_event' => 'required',
                // comented by kandarp pandya 01-09-2018
                // 'survey_form_id' => 'required',
                'sending_method' => 'required',
                'template_dropdown' => 'required'
            ];
        }else{
           return [
                'trigger_name' => 'required',
                'waiting_time' => $request->get('immediately') ? '' : 'required',
                'waiting_time_formate' => 'required',
                'trigger_event' => 'required',
                // comented by kandarp pandya 01-09-2018
                // 'survey_form_id' => 'required',
                'sending_method' => 'required',
                'template_dropdown' => 'required'
                
            ]; 
        }

    }


    public function messages()
    {    
        if($_POST['form_action']=='update_form'){
            return [
                'trigger_name.required' => 'Please enter trigger name',
                'waiting_time.required' => 'Please enter trigger hours',
                'waiting_time_formate.required' => 'Please select time format',
                'trigger_event.required' => 'Please select event trigger',
                'survey_form_id.required' => 'Please select survey name',
                'sending_method.required' => 'Please select sending method',
                'template_dropdown.required' => 'Please select template',
            ];
            
        }else{
            return [
                'trigger_name.required' => 'Please enter trigger name',
                'waiting_time.required' => 'Please enter trigger hours',
                'waiting_time_formate.required' => 'Please select time format',
                'trigger_event.required' => 'Please select event trigger',
                'survey_form_id.required' => 'Please select survey name',
                'sending_method.required' => 'Please select sending method',
                'template_dropdown.required' => 'Please select template',
            ];
        }  
    }


    
    

}

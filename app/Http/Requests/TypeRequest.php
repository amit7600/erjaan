<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeRequest extends FormRequest {

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
        if($_POST['form_action']=='update_form'){
            return [
                'type_name' => 'required'
            ];
        }else{
           return [
                'type_name' => 'required'
                
            ]; 
        }

    }

    public function messages()
    {    
        if($_POST['form_action']=='update_form'){
            return [
                'type_name.required' => 'Please enter type name'
            ];
            
        }else{
            return [
                'type_name.required' => 'Please enter type name'
            ];
        }  
    }


    
    

}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest {

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
        if($_REQUEST['form_action']=='update_form'){
            return [
                'category_name' => 'required'
            ];
        }else{
           return [
                'category_name' => 'required'
                
            ]; 
        }

    }

    public function messages()
    {    
        if($_REQUEST['form_action']=='update_form'){
            return [
                'category_name.required' => 'Please enter category name'
            ];
            
        }else{
            return [
                'category_name.required' => 'Please enter category name'
            ];
        }  
    }


    
    

}

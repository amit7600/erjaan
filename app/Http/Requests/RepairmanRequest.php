<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RepairmanRequest extends FormRequest {

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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'business_name' => 'required',
            'mobile_number' => 'required',
            'city' => 'required',
            'country' => 'required',

        );
        
        switch ($this->method()) {
            case 'PUT':
                $id = $this->segment(3);
                $arr['email'] = "required|unique:users,email,$id,id";
                break;
        }     
        
        return $arr;
    }
    
    

}

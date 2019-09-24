<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class ParticipantRequest extends FormRequest {

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
            $user_id = $_POST['user_id'];
            return [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:tbl_participants,email,'.$user_id,
                'mobile' => 'required',
                // 'gender' => 'required',
                // 'dob' => 'required',
                // 'location_id' => 'required',
                // 'category_id' => 'required',
                // 'group_id' => 'required',
                // 'type_id' => 'required',
                // 'comment' => 'required',
            ];
        }else{
            return [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:tbl_participants',
                'mobile' => 'required',
                // 'gender' => 'required',
                // 'dob' => 'required',
                // 'location_id' => 'required',
                // 'category_id' => 'required',
                // 'group_id' => 'required',
                // 'type_id' => 'required',
                // 'comment' => 'required',
            ]; 
        }

    }

    public function messages()
    {
        if($_POST['form_action']=='update_form'){
            return [
                'first_name.required' => 'Please enter first name',
                'last_name.required' => 'Please enter last name',
                'email.required' => 'Please enter email',
                'email.unique' => 'Email already exist',
                'mobile.required' => 'Please enter mobile',
                // 'gender.required' => 'Please select gender',
                // 'dob.required' => 'Please select date of birth',
                // 'location_id.required' => 'Please select location',
                // 'category_id.required' => 'Please select category',
                // 'group_id.required' => 'Please select group',
                // 'type_id.required' => 'Please select type',
                // 'comment.required' => 'Please enter comment',
            ];
            
        }else{
            return [
                'first_name.required' => 'Please enter first name',
                'last_name.required' => 'Please enter last name',
                'email.required' => 'Please enter email',
                'email.unique' => 'Email already exist',
                'mobile.required' => 'Please enter mobile',
                // 'gender.required' => 'Please select gender',
                // 'dob.required' => 'Please select date of birth',
                // 'location_id.required' => 'Please select location',
                // 'category_id.required' => 'Please select category',
                // 'group_id.required' => 'Please select group',
                // 'type_id.required' => 'Please select type',
                // 'comment.required' => 'Please enter comment',
            ];
        }  
    }


    
    

}

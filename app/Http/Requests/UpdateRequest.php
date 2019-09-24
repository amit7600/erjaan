<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'name'=>'required',
            'business_name'=>'required',
            'mobile_number'=>'required',
            'city'=>'required',
            'country'=>'required',
        );
        if(!empty($_FILES['user_image']['tmp_name'])){
            $arr['user_image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:20480';
        }
        
        return $arr;
    }
}

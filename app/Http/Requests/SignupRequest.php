<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class SignupRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'user_role'=>'required',
            'device_type'=>'required',
        );
        if(!empty($_POST['user_role']) && $_POST['user_role'] == 2){
            $arr['plan_id'] = 'required|exists:plans,id';
            $arr['tranx_id'] = 'required'; 
        }
        if(!empty($_POST['age'])){
            $arr['age'] = 'numeric';
        }
        
        return $arr;
    }

    public function response(array $errors)
    {
        if ($this->ajax())
        {
            foreach($errors as $errObj){
                $firstError = $errObj[0];
                break;
            }
            //return new JsonResponse(array('status'=>false,'message' => $firstError));
            echo json_encode(array('status'=>false,'message' => $firstError));
            exit();
        }
        return $this->redirector->to($this->getRedirectUrl())
            ->withInput($this->except($this->dontFlash))
            ->withErrors($errors, $this->errorBag);
    }
}

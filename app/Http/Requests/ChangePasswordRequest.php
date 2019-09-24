<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class ChangepasswordRequest extends FormRequest
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
        return [
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|min:6'
        ];
    }

    // public function response(array $errors) {
    //     if ($this->ajax()) {
    //         return new JsonResponse(array('errors' => $errors));
    //     } 
    //     die("DFasdf");      
    //     return $this->redirector->to($this->getRedirectUrl())
    //         ->withInput($this->except($this->dontFlash))
    //         ->withErrors($errors, $this->errorBag);
    // }
}

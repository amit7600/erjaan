<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class SMSTemplateRequest extends FormRequest
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
            'title'=>'required|unique:tbl_sms_template',
            'content'=>'required',

        );   
        switch ($this->method()) {
            case 'PUT':
                $id = $this->segment(3);
                $arr['title'] = "required|unique:tbl_sms_template,title,$id,id";
                break;
            
            default:
                # code...
                break;
        }     
        
        return $arr;
    }

    public function messages()
    {
        return [
            'title.required' => 'Please enter title',
            'title.unique' => 'Title already exist. Please try new one',
            'content.required' => 'Please enter content',
        ];
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

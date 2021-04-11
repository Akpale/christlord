<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            //
            //'title'=>$this->method()=='POST'?
           'gpusers_id'=>['required'],
           'groupe_id'=>['required'],
           'pseudo'=>['required','min:3','max:20','unique:users,pseudo'],
           'name'=>['required','min:3','max:20'],
           'email'=>['required','unique:users,email'],
           'password'=>['required','min:3','max:20'],
           'avatar'=>['sometimes','nullable','file','image','mimes:jpeg,png'],
           
        ];
    }
}

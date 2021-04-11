<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            //['required','max:20','unique:articles,title']:
            //['required','max:20',Rule::unique('articles','title')->ignore($this->article)],
            //'content'=>['required'],
            //'category'=>['sometimes','nullable','exists:categories,id'],
        
        //'id'=>$this->method()=='POST'?

        'groupe_id'=>['sometimes','nullable','exists:groupes,id'],

        'gpusers_id'=>['sometimes','nullable','exists:gpusers,id'],

        'name'=>['required','min:3','max:20'],

        'pseudo'=>['required','min:3','max:20'],

        'email'=>['required','email'],

        'avatar'=>['sometimes','nullable','file','image','mimes:jpeg,png,jpg','dimensions:min_width=200,min_height=200'], 

        //'password'=>['required','min:3','max:20'],
        ];
    }
}

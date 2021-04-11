<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MembreRequest extends FormRequest
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
        
        'civilite'=>'required|max:4',
        'nom'=>'required|between:2,30',
        'prenoms'=>'required|between:2,30',
        'date_naissance'=>'required',
        //'email'=>['required','email',Rule::unique('membres')->ignore($membre)],
        'email'=>'required|unique:membres',
        'photo'=>['sometimes','nullable','file','image','mimes:jpeg,png,jpg','dimensions:min_width=200,min_height=200'],
        'profession'=>'required|max:30',
        'contact'=>'required|max:10', 
        
        ];
    }

}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FichierRequest extends FormRequest
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
        'date_activite'=>'required|unique:groupes',
        //'email'=>['required','email',Rule::unique('membres')->ignore($membre)],
        'description'=>'required',
        'filename'=>['sometimes','nullable','file','mimes:jpeg,pdf,doc,docx'],
        ];
    }
}

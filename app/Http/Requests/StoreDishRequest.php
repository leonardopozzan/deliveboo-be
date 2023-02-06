<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDishRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50|min:3',
            'ingredients' => 'required',

            'price' => 'required|numeric|between:0,999',

            'category_id' => 'required|exists:categories,id',
            'visible' => 'required',  

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Il nome è obbligatorio.',
            'name.min' => 'Il nome deve essere lungo almeno :min caratteri.',
            'name.max' => 'Il nome non può superare i :max caratteri.',

            'ingredients.required' => 'Gli ingredienti sono obbligatori.',

            'price.required' => 'Il prezzo è obbligatorio.',
            'price.min' => 'Il prezzo del piatto deve essere di almeno :min euro.',
            'price.max' => 'Il prezzo del piatto non può superare i :max euro.',

            'category_id.required' => 'La categoria del piatto è obbligatoria.',

            'visible.required' => 'La visibilità del piatto è obbligatoria.',
        ];
    }
}

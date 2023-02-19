<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
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
            'name' => ['required','max:50','min:3',Rule::unique('dishes')->where('restaurant_id' , Auth::user()->restaurant->id)->ignore($this->dish)],
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
            'name.unique' => 'Il nome esiste già.',


            'ingredients.required' => 'Gli ingredienti sono obbligatori.',

            'price.required' => 'Il prezzo è obbligatorio.',
            'price.between' => 'Il prezzo deve essere compreso tra 0 e 999',
            'price.numeric' => 'Il prezzo deve essere un numero',


            'category_id.required' => 'La categoria del piatto è obbligatoria.',
            'category_id.exists' => 'La categoria del piatto non esiste.',


            'visible.required' => 'La visibilità del piatto è obbligatoria.',
        ];
    }
}

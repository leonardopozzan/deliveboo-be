<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
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
            'name' =>'required|unique:restaurants|max:100|min:3',
            'email' =>'required|unique:restaurants|email|max:100|min:3',
            'address' =>'required|max:255|min:3',
            'p_iva' =>'required|size:13|regex:/^([I,T]){2}([0-9]){11}$/|starts_with:IT',
            'website' => 'nullable|url',
            'opening_hours' => 'required|date_format:H:i',
            'closing_hours' => 'required|date_format:H:i',
            'phone_number' => 'required|regex:/^([0-9]*)$/|size:10'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Il nome è obbligatorio.',
            'name.min' => 'Il nome deve essere lungo almeno :min caratteri.',
            'name.max' => 'Il nome non può superare i :max caratteri.',
            'name.unique:restaurants' => 'Il nome esiste già',

            'email.required' => 'L\'email è obbligatoria.',
            'email.min' => 'L\'email deve essere lunga almeno :min caratteri.',
            'email.max' => 'L\'email non può superare i :max caratteri.',
            'email.unique:restaurants' => 'L\'email esiste già',

            'address.required' => 'L\'indirizzo è obbligatorio.',
            'address.min' => 'L\'indirizzo deve essere lungo almeno :min caratteri.',
            'address.max' => 'L\'indirizzo non può superare i :max caratteri.',

            'p_iva.required' => 'La partita iva è obbligatoria.',
            'p_iva.size' => 'La partita iva deve essere lunga esattamente :size caratteri.',
            'p_iva.regex' => 'La partita deve essere scritta come IT99999999999.',
            'p_iva.starts_with' => 'La partita iva deve iniziare con IT.',

            'website.url' => 'Il sito web deve essere un url.',

            'opening_hours.required' => 'L\'orario di apertura è obbligatorio.',
            'opening_hours.date_format' => 'L\'orario di apertura deve essere nel formato hh:mm.',

            'closing_hours.required' => 'L\'orario di apertura è obbligatorio.',
            'closing_hours.date_format' => 'L\'orario di apertura deve essere nel formato hh:mm.',

            'phone_number.required' => 'Il numero di telefono è obbligatorio.',
            'phone_number.size' => 'Il numero di telefono deve essere lungo esattamente :size caratteri.',
            'phone_number.regex' => 'Il numero di telefono può contenere solo numeri.',
        ];
    }
}

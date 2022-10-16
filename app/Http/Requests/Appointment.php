<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Appointment extends FormRequest
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
            'title' => 'required'
        ];
    }
    /**
     * @Route("Route", name="RouteName")
     */
    public function message()
    {
       return [
        'title.required' => 'Vous devez remplir ce champ'
       ];
    }
}

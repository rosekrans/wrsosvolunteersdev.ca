<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCallLog extends FormRequest
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
        $rules = [
            'call_type_id' => 'required',
            'animal_species' => 'nullable|exists:species,species_name',
            'open_date' => 'required',
            'close_date' => 'nullable',
            'call_status' => 'required',
            'caller_location_id' => 'required',
            'volunteer_hotline' => 'required'
        ];

        if ($this->call_status == 'Closed') {
             $rules['animal_solution_type_id'] = 'required';
        }
        
        return $rules;
    }
}

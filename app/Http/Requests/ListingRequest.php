<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListingRequest extends FormRequest
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
          'beds' => 'required|integer|min:0|max:20',
          'bathrooms' => 'required|integer|min:0|max:20',
          'area' => 'required|integer|min:15|max:1500',
          'city' => 'required|max:40',
          'postal_code' => 'required|max:20',
          'street' => 'required|max:100',
          'street_number' => 'required|min:1|max:20',
          'price' => 'required|integer|min:1|max:20000000',
        ];
    }
}

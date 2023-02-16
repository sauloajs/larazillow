<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RealtorListingImageRequest extends FormRequest
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
            'images.*' => 'mimes:jpg,png,jpeg|max:5000'
        ];
    }

    /**
     * Custom messages
     *
     * @return array
     */
    public function messages()
    {
        return
        [
            'images.*.mimes'
                => 'The file should be in one of the formats: jpg, png, jpeg',
            'images.*.max' => 'The file should be shorter than 5MB'
        ];
    }
}

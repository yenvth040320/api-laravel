<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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
            'code'         =>'required',
            'name'          => 'required',
            'category_id'   => 'required|integer',
            'description'   => 'required',
            'image_url'     => 'required|image|mimes:jpeg,png|mimetypes:image/jpeg,image/png|max:2048',
            'price'   => 'required|integer',
            'quantity'   => 'required|integer',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response() -> json([$validator->errors()], 422));
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MealRequest extends FormRequest
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
            'lang' => 'required',
            'tags' => 'sometimes|min:1',
            'diff_time' => 'sometimes|date_format:U',
            'per_page' => 'sometimes|between:1,1',
            'page' => 'sometimes|between:1,1',
            'category' => 'sometimes|min:1'
        ];
    }

    public function messages()
    {
        return [
            'lang.required' => 'Izbor jezika je obavezan / lang=hr or lang=en',
            'tags.min' => 'Mora biti upisan minimalno jedan ID',
            'diff_time.date_format' => 'Parametar dif_time mora bit u formatu UNIX timestamp',
            'per_page.between' => 'Mora bit izabran samo jedan broj',
            'page.between' => 'Mora bit izabran samo jedan broj',
            'category.min' => 'mora biti upisan samo jedan uvijet ID, null, !null',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = [
            'message' => $validator->errors()->first(),
        ];
        throw new HttpResponseException(response()->json($response, 200));
    }
}

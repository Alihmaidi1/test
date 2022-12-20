<?php

namespace App\Http\Requests\invertory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class store extends FormRequest
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

            "unit_id"=>"required|exists:units,id",
            "product_id"=>"required|exists:products,id",
            "amount"=>"required"
        ];
    }



    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){

        throw new HttpResponseException(

            response()->json(["data"=>[],"status"=>402,"message"=>$validator->errors()->first()])

        );

    }

}

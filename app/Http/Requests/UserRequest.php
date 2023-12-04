<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // default $rules for create user
        $rules = [ 
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|max:100",
            "role" => "required|in:admin,resepsionis|string",
        ];
        if (str_contains($this->getRequestUri(), "login")) { // if path has login
            $rules = [
                "email" => "required|email|max:100",
                "password" => "required|string|max:100",
            ];
        } else if ($this->isMethod("PATCH")) { // if request method patch
            $rules = [
                "name" => "nullable|string|max:255",
                "email" => "nullable|string|email|max:255|unique:users",
                "password" => "nullable|string|max:100",
                "role" => "nullable|in:admin,resepsionis|string",
            ];
        }
        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            "errors" => $validator->getMessageBag(),
        ], 400));

    }
}

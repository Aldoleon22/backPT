<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
       if(requesr()->isMethod('post')){
        return[
            'name' => 'required|string|max:258',
            'email' => 'required|string',
            'password' => 'required|string'
        ];

       }else {
            return[
                'name' => 'required|string|max:258',
            'email' => 'required|string',
            'password' => 'required|string'
            ];
        };
    }
       public function message()
       {
        if(requesr()->isMethod('post')){
            return[
                'name.required' => 'name is required',
                'email.required' => 'email is required',
                'password.required' => 'password is required',


            ];

       }
       else{
        return[
            'name.required' => 'name is required',
            'email.required' => 'email is required',
            'password.required' => 'password is required',


        ];
       }

    }
    }



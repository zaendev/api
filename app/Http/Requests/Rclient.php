<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use Illuminate\Http\Request;

class Rclient extends FormRequest
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
    public function rules(Request $request)
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'name' => 'required|string',
                        'email' => 'required|string|email|unique:users',
                        'password' => 'required|string|confirmed'
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'name' => 'required|string',
                        'email' => 'required|string|email|unique:users,email,'.$request->segment(2),
                        'password' => 'confirmed'
                    ];
                }
            default:
                break;
        }
    }

    public function messages() {
        return [
            //
        ];
    }
}
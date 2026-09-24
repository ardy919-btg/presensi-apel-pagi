<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        /*
        |--------------------------------------------------------------------------
        | Admin
        |--------------------------------------------------------------------------
        */

        if ($this->user()->role === 'admin') {

            return [

                'name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'email' => [
                    'required',
                    'string',
                    'lowercase',
                    'email',
                    'max:255',

                    Rule::unique(
                        User::class
                    )->ignore(
                        $this->user()->id
                    ),
                ],
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | Pegawai
        |--------------------------------------------------------------------------
        */

        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'jabatan' => [
                'nullable',
                'string',
                'max:255',
            ],

            'email' => [
                'nullable',
                'string',
                'lowercase',
                'email',
                'max:255',

                Rule::unique(
                    User::class
                )->ignore(
                    $this->user()->id
                ),
            ],
        ];
    }
}
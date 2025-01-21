<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'age' => ['required', 'integer'],
            'height' => ['required', 'integer'],
            'role' => ['nullable', 'integer'],
            'gender' => ['required', 'integer'],
            'mobile_phone' => ['required', 'string', 'max:255'],
            'profile_picture' => ['nullable'],
            'password' => ['nullable', 'string', 'min:8'],
        ];
    }
}

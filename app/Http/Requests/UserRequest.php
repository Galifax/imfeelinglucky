<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $username
 * @property string $phonenumber
 */
class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'username'      => 'required|string|max:20|unique:users,username',
            'phonenumber'   =>  [
                'required',
                new PhoneNumber,
                'unique:users,phonenumber'
            ],
        ];
    }
}

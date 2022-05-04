<?php

namespace ConsulConfigManager\Users\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use ConsulConfigManager\Users\ValueObjects\PasswordValueObject;
use ConsulConfigManager\Users\ValueObjects\UsernameValueObject;

/**
 * Class UserCreateRequest
 * @package ConsulConfigManager\Users\Http\Requests\User
 */
class UserCreateRequest extends FormRequest
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
     * @return array<array>
     */
    public function rules(): array
    {
        return [
            'guid'              =>  ['string', 'nullable'],
            'domain'            =>  ['string', 'nullable'],
            'first_name'        =>  ['required', 'string'],
            'last_name'         =>  ['required', 'string'],
            'username'          =>  ['required', 'string', 'min:4', 'max:16', 'regex:' . UsernameValueObject::VALIDATION_REGEX],
            'email'             =>  ['required', 'email'],
            'password'          =>  ['required', 'string'],
        ];
    }
}

<?php

namespace ConsulConfigManager\Users\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserDeleteRequest
 * @package ConsulConfigManager\Users\Http\Requests\User
 */
class UserDeleteRequest extends FormRequest
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
            'id'        =>  ['required', 'integer'],
        ];
    }
}

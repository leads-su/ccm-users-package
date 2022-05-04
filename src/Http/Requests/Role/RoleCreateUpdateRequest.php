<?php

namespace ConsulConfigManager\Users\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RoleCreateUpdateRequest
 * @package ConsulConfigManager\Users\Http\Requests\Role
 */
class RoleCreateUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'              =>  'required|string|max:60',
            'guard_name'        =>  'required|string|max:60',
            'permissions'       =>  'array',
        ];
    }
}

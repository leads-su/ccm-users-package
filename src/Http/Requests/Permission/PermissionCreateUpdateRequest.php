<?php

namespace ConsulConfigManager\Users\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PermissionCreateUpdateRequest
 * @package ConsulConfigManager\Users\Http\Requests\Permission
 */
class PermissionCreateUpdateRequest extends FormRequest
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
            'name'              =>  'string|max:60',
            'guard_name'        =>  'string|max:60',
        ];
    }
}

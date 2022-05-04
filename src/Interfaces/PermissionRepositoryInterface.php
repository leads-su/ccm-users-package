<?php

namespace ConsulConfigManager\Users\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Contracts\Permission;
use Illuminate\Database\Eloquent\Collection;
use ConsulConfigManager\Users\Http\Requests\Permission\PermissionCreateUpdateRequest;

/**
 * Interface PermissionRepositoryInterface
 * @package ConsulConfigManager\Users\Interfaces
 */
interface PermissionRepositoryInterface
{
    /**
     * Get list of all permissions
     * @param array|string[] $columns
     *
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection;

    /**
     * Find permission by ID
     * @param int            $id
     * @param array|string[] $columns
     * @param bool           $notFoundFail
     *
     * @return Permission|Model|null
     */
    public function findByID(int $id, array $columns = ['*'], bool $notFoundFail = false): Permission|Model|null;

    /**
     * Find permission by given field => value match
     * @param string         $field
     * @param mixed          $value
     * @param array|string[] $columns
     * @param bool           $notFoundFail
     *
     * @return Permission|Model|null
     */
    public function findBy(string $field, mixed $value, array $columns = ['*'], bool $notFoundFail = false): Permission|Model|null;

    /**
     * Create new permission
     * @param PermissionCreateUpdateRequest $request
     *
     * @return Permission|Model
     */
    public function create(PermissionCreateUpdateRequest $request): Permission|Model;

    /**
     * Update existing permission
     * @param string                        $permissionID
     * @param PermissionCreateUpdateRequest $request
     *
     * @return Permission|Model
     */
    public function update(string $permissionID, PermissionCreateUpdateRequest $request): Permission|Model;

    /**
     * Delete existing permission
     *
     * @param string $permissionID
     * @param bool   $force
     *
     * @return bool
     */
    public function delete(string $permissionID, bool $force = false): bool;

    /**
     * Force delete existing permission
     * @param string $permissionID
     *
     * @return bool
     */
    public function forceDelete(string $permissionID): bool;
}

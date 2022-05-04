<?php

namespace ConsulConfigManager\Users\Interfaces;

use Spatie\Permission\Contracts\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use ConsulConfigManager\Users\Http\Requests\Role\RoleCreateUpdateRequest;

/**
 * Interface RoleRepositoryInterface
 * @package ConsulConfigManager\Users\Interfaces
 */
interface RoleRepositoryInterface
{
    /**
     * Get list of all roles
     * @param array|string[] $columns
     *
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection;

    /**
     * Attach relations to request
     * @param string ...$relation
     *
     * @return self|$this
     */
    public function with(string ... $relation): self;

    /**
     * Find role by ID
     * @param int            $id
     * @param array|string[] $columns
     * @param bool           $notFoundFail
     *
     * @return Role|Model|null
     */
    public function findByID(int $id, array $columns = ['*'], bool $notFoundFail = false): Role|Model|null;

    /**
     * Find role by given field => value match
     * @param string         $field
     * @param mixed          $value
     * @param array|string[] $columns
     * @param bool           $notFoundFail
     *
     * @return Role|Model|null
     */
    public function findBy(string $field, mixed $value, array $columns = ['*'], bool $notFoundFail = false): Role|Model|null;

    /**
     * Create new role
     * @param RoleCreateUpdateRequest $request
     *
     * @return Role|Model
     */
    public function create(RoleCreateUpdateRequest $request): Role|Model;

    /**
     * Update existing role
     * @param string                  $roleID
     * @param RoleCreateUpdateRequest $request
     *
     * @return Role|Model
     */
    public function update(string $roleID, RoleCreateUpdateRequest $request): Role|Model;

    /**
     * Delete existing role
     *
     * @param string $roleID
     * @param bool   $force
     *
     * @return bool
     */
    public function delete(string $roleID, bool $force = false): bool;

    /**
     * Force delete existing role
     * @param string $roleID
     *
     * @return bool
     */
    public function forceDelete(string $roleID): bool;
}

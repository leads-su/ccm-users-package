<?php

namespace ConsulConfigManager\Users\Repositories;

use Throwable;
use Illuminate\Support\Arr;
use Spatie\Permission\Contracts\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role as RoleModel;
use ConsulConfigManager\Users\Interfaces\RoleRepositoryInterface;
use ConsulConfigManager\Users\Http\Requests\Role\RoleCreateUpdateRequest;

/**
 * Class RoleRepository
 * @package ConsulConfigManager\Users\Repositories
 */
class RoleRepository implements RoleRepositoryInterface
{
    /**
     * List of relations to attach to request
     * @var array
     */
    protected array $with = [];

    /**
     * @inheritDoc
     */
    public function all(array $columns = ['*']): Collection
    {
        return RoleModel::with($this->with)->get($columns);
    }

    /**
     * @inheritDoc
     */
    public function with(string ...$relation): self
    {
        $this->with = $relation;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function findByID(int $id, array $columns = ['*'], bool $notFoundFail = false): Role|Model|null
    {
        return $this->findBy('id', $id, $columns, $notFoundFail);
    }

    /**
     * @inheritDoc
     */
    public function findBy(string $field, mixed $value, array $columns = ['*'], bool $notFoundFail = false): Role|Model|null
    {
        $query = RoleModel::where($field, '=', $value)->with($this->with);
        if ($notFoundFail) {
            return $query->firstOrFail($columns);
        }
        return $query->first($columns);
    }

    /**
     * @inheritDoc
     */
    public function create(RoleCreateUpdateRequest $request): Role|Model
    {
        $modelData = $request->validated();

        $permissions = Arr::get($modelData, 'permissions', []);
        Arr::forget($modelData, 'permissions');
        $model = RoleModel::create($modelData);
        $this->processPermissions($model, $permissions);
        return $this->findByID(id: $model->id, notFoundFail: true);
    }

    /**
     * @inheritDoc
     */
    public function update(string $roleID, RoleCreateUpdateRequest $request): Role|Model
    {
        $roleID = intval($roleID);
        $model = $this->findByID(id: $roleID, notFoundFail: true);

        $modelData = $request->validated();
        $permissions = Arr::get($modelData, 'permissions');
        Arr::forget($modelData, ['permissions', 'name']);

        $model->update($modelData);
        $this->processPermissions($model, $permissions);
        return $this->findByID(id: $roleID, notFoundFail: true);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $roleID, bool $force = false): bool
    {
        $roleID = intval($roleID);
        try {
            $model = $this->findByID(id: $roleID, notFoundFail: true);
            $deletionStatus = $force ? $model->forceDelete() : $model->delete();
            // @codeCoverageIgnoreStart
            if ($deletionStatus === null) {
                return false;
            }
            // @codeCoverageIgnoreEnd
            return $deletionStatus;
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function forceDelete(string $roleID): bool
    {
        return $this->delete($roleID, true);
    }

    /**
     * Process list of provided permissions and apply/remove them to/from model
     * @param Role  $role
     * @param array $permissions
     * @return void
     */
    public function processPermissions(Role $role, array $permissions): void
    {
        $existingPermissions = array_map(function (array $permission): int {
            return Arr::get($permission, 'id');
        }, $role->permissions()->get(['id'])->toArray());

        $newPermissions = array_diff($permissions, $existingPermissions);
        $revokedPermissions = array_diff($existingPermissions, $permissions);

        foreach ($newPermissions as $permission) {
            $role->givePermissionTo($permission);
        }

        foreach ($revokedPermissions as $permission) {
            $role->revokePermissionTo($permission);
        }
    }
}

<?php

namespace ConsulConfigManager\Users\Repositories;

use Throwable;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Contracts\Permission;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Permission as PermissionModel;
use ConsulConfigManager\Users\Interfaces\PermissionRepositoryInterface;
use ConsulConfigManager\Users\Http\Requests\Permission\PermissionCreateUpdateRequest;

/**
 * Class PermissionRepository
 * @package ConsulConfigManager\Users\Repositories
 */
class PermissionRepository implements PermissionRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function all(array $columns = ['*']): Collection
    {
        return PermissionModel::all($columns);
    }

    /**
     * @inheritDoc
     */
    public function findByID(int $id, array $columns = ['*'], bool $notFoundFail = false): Permission|Model|null
    {
        return $this->findBy('id', $id, $columns, $notFoundFail);
    }

    /**
     * @inheritDoc
     */
    public function findBy(string $field, mixed $value, array $columns = ['*'], bool $notFoundFail = false): Permission|Model|null
    {
        $query = PermissionModel::where($field, '=', $value);
        if ($notFoundFail) {
            return $query->firstOrFail($columns);
        }
        return $query->first($columns);
    }

    /**
     * @inheritDoc
     */
    public function create(PermissionCreateUpdateRequest $request): Permission|Model
    {
        $modelData = $request->validated();
        return PermissionModel::create($modelData);
    }

    /**
     * @inheritDoc
     */
    public function update(string $permissionID, PermissionCreateUpdateRequest $request): Permission|Model
    {
        $permissionID = intval($permissionID);
        $model = $this->findByID(id: $permissionID, notFoundFail: true);
        $modelData = Arr::except($request->validated(), ['name']);
        $model->update($modelData);
        return $this->findByID(id: $permissionID, notFoundFail: true);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $permissionID, bool $force = false): bool
    {
        $permissionID = intval($permissionID);
        try {
            $model = $this->findByID(id: $permissionID, notFoundFail: true);
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
    public function forceDelete(string $permissionID): bool
    {
        return $this->delete($permissionID, true);
    }
}

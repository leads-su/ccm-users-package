<?php

namespace ConsulConfigManager\Users\Database\Seeders;

use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class RolesPermissionsSeeder
 *
 * @package Database\Seeders
 */
class RolesPermissionsSeeder extends Seeder
{
    /**
     * Indicates whether running inside tests
     * @var bool
     */
    protected bool $inTests = false;

    /**
     * List of available roles
     * @var array
     */
    protected array $roles = [
        'administrator'         =>  [
            'from'              =>  0,
            'to'                =>  9999,
            'include'           =>  [],
            'inclusive'         =>  true,
        ],
        'project_manager'       =>  [
            'from'              =>  600,
            'to'                =>  699,
            'include'           =>  [100],
            'inclusive'         =>  true,
        ],
        'developer'             =>  [
            'from'              =>  0,
            'to'                =>  0,
            'include'           =>  [100, 600, 620],
            'inclusive'         =>  true,
        ],
        'guest'                 =>  [
            'from'              =>  0,
            'to'                =>  0,
            'include'           =>  [100],
            'inclusive'         =>  true,
        ],
    ];

    /**
     * List of available permissions
     * @var array
     */
    protected array $permissions = [
        // Dashboard Permissions
        100     =>  'dashboard view',

        // Consul ACL Permissions
        200     =>  'consul acl',

        220     =>  'consul acl policies view',
        221     =>  'consul acl policies create',
        222     =>  'consul acl policies update',
        223     =>  'consul acl policies delete',
        224     =>  'consul acl policies view value',

        240     =>  'consul acl roles view',
        241     =>  'consul acl roles create',
        242     =>  'consul acl roles update',
        243     =>  'consul acl roles delete',
        244     =>  'consul acl roles view value',

        260     =>  'consul acl tokens view',
        261     =>  'consul acl tokens create',
        262     =>  'consul acl tokens update',
        263     =>  'consul acl tokens delete',
        264     =>  'consul acl tokens view value',
        265     =>  'consul acl tokens clone',

        // Consul Agent Permissions
        300     =>  'consul agent',

        320     =>  'consul agent checks view',
        321     =>  'consul agent checks create',
        322     =>  'consul agent checks update',
        323     =>  'consul agent checks delete',
        324     =>  'consul agent checks view value',

        340     =>  'consul agent services view',
        341     =>  'consul agent services create',
        342     =>  'consul agent services update',
        343     =>  'consul agent services delete',
        344     =>  'consul agent services view value',

        // Consul Catalog Permissions
        400     =>  'consul catalog',
        401     =>  'consul catalog datacenters view',
        402     =>  'consul catalog nodes view',
        403     =>  'consul catalog services view',

        // Consul KV Permissions
        600     =>  'consul kv',

        620     =>  'consul kv view',
        621     =>  'consul kv create',
        622     =>  'consul kv update',
        623     =>  'consul kv delete',
        624     =>  'consul kv view value',

        // Settings Permissions
        1500    =>  'settings view',

        1511    =>  'settings servers view',
        1512    =>  'settings servers create',
        1513    =>  'settings servers update',
        1514    =>  'settings servers delete',

        1520    =>  'settings services view',
        1521    =>  'settings services create',
        1522    =>  'settings services update',
        1523    =>  'settings services delete',

        // Users Permissions
        1600    =>  'users view',

        1620    =>  'users users view',
        1621    =>  'users users create',
        1622    =>  'users users update',
        1623    =>  'users users delete',

        1640    =>  'users roles view',
        1641    =>  'users roles create',
        1642    =>  'users roles update',
        1643    =>  'users roles delete',

        1660    =>  'users permissions view',
        1661    =>  'users permissions create',
        1662    =>  'users permissions update',
        1663    =>  'users permissions delete',

        // Logs Permissions
        1700    =>  'logs view',


        // Task Manager Permissions
        1800    =>  'task manager view',

        // Task Manager Actions Permissions
        1810    =>  'task manager actions view',
        1811    =>  'task manager actions create',
        1812    =>  'task manager actions update',
        1813    =>  'task manager actions delete',
        1814    =>  'task manager actions restore',
        1815    =>  'task manager actions start',
        1816    =>  'task manager actions stop',

        // Task Manager Tasks Permissions
        1820    =>  'task manager tasks view',
        1821    =>  'task manager tasks create',
        1822    =>  'task manager tasks update',
        1823    =>  'task manager tasks delete',
        1824    =>  'task manager tasks restore',
        1825    =>  'task manager tasks start',
        1826    =>  'task manager tasks stop',

        // Task Manager Pipelines Permissions
        1830    =>  'task manager pipelines view',
        1831    =>  'task manager pipelines create',
        1832    =>  'task manager pipelines update',
        1833    =>  'task manager pipelines delete',
        1834    =>  'task manager pipelines restore',
        1835    =>  'task manager pipelines start',
        1836    =>  'task manager pipelines stop',

        // Task Manager History Permissions
        1840    =>  'task manager history view',
        1841    =>  'task manager history create',
        1842    =>  'task manager history update',
        1843    =>  'task manager history delete',

        // Task Manager Permissions Permissions
        1849    =>  'task manager permissions view',

        // Task Manager Pipeline Permissions Permissions
        1850    =>  'task manager permissions pipeline view',
        1851    =>  'task manager permissions pipeline create',
        1852    =>  'task manager permissions pipeline delete',

        // Task Manager Task Permissions Permissions
        1860    =>  'task manager permissions task view',
        1861    =>  'task manager permissions task create',
        1862    =>  'task manager permissions task delete',

        // Task Manager Action Permissions Permissions
        1870    =>  'task manager permissions action view',
        1871    =>  'task manager permissions action create',
        1872    =>  'task manager permissions action delete',
    ];

    /**
     * Run the database seeds.
     * @return void
     */
    public function run(): void
    {
        if ($this->inTests) {
            $this->permissions = [
                100     =>  'dashboard view',
                600     =>  'consul kv',
                620     =>  'consul kv view',
            ];
        }

        $permissions = $this->permissions();
        $roles = $this->roles();

        foreach ($roles as $roleName => $roleModel) {
            $rolePermissions = $this->rolesPermission($roleName);
            foreach ($rolePermissions as $permissionIndex) {
                $permissionModel = $permissions[$permissionIndex];
                if (!$roleModel->hasPermissionTo($permissionModel)) {
                    $roleModel->givePermissionTo($permissionModel);
                }
            }
        }
    }

    /**
     * Get list of roles with attached permissions
     *
     * @param string|null $take
     *
     * @return array
     */
    protected function rolesPermission(?string $take = null): array
    {
        $roles = [];

        foreach ($this->roles as $role => $parameters) {
            if ($take !== null && $role !== $take) {
                continue;
            }
            $roles[$role] = array_merge(
                Arr::get($parameters, 'include', []),
                array_keys($this->array_keys_between(
                    $this->permissions,
                    Arr::get($parameters, 'from', 0),
                    Arr::get($parameters, 'to', 0),
                    Arr::get($parameters, 'inclusive', false),
                ))
            );
        }

        if ($take !== null) {
            return $roles[$take];
        }

        return $roles;
    }

    /**
     * Get list of permissions as models
     * @return array|Permission[]
     */
    protected function permissions(): array
    {
        $permissions = [];

        foreach ($this->permissions as $index => $permission) {
            $permissions[$index] = $this->createPermission($permission);
        }

        return $permissions;
    }

    /**
     * Get list of roles as models
     * @return array|Role[]
     */
    protected function roles(): array
    {
        $roles = [];

        foreach ($this->rolesPermission() as $role => $rolePermissions) {
            $roles[$role] = $this->createRole($role);
        }

        return $roles;
    }

    /**
     * Create new permission
     * @param string $permissionName
     *
     * @return Permission
     */
    private function createPermission(string $permissionName): Permission
    {
        if (!$this->inTests) {
            $model = Permission::where('name', '=', $permissionName)->where('guard_name', '=', 'api')->first();
            if ($model) {
                return $model;
            }
        }
        return Permission::create([
            'name'          =>  $permissionName,
            'guard_name'    =>  'api',
        ]);
    }

    /**
     * Create new role
     * @param string $roleName
     *
     * @return Role
     */
    private function createRole(string $roleName): Role
    {
        if (!$this->inTests) {
            $model = Role::where('name', '=', $roleName)->where('guard_name', '=', 'api')->first();
            if ($model) {
                return $model;
            }
        }
        return Role::create([
            'name'          =>  $roleName,
            'guard_name'    =>  'api',
        ]);
    }

    /**
     * Returns list of keys between specified number
     * @param array $array
     * @param int   $from
     * @param int   $to
     * @param bool  $include
     *
     * @return array
     */
    private function array_keys_between(array $array, int $from, int $to, bool $include = false): array
    {
        $keys = [];
        if ($include) {
            $from--;
            $to++;
        }
        foreach ($array as $key => $value) {
            if ($key > $from && $key < $to) {
                $keys[$key] = $value;
            }
        }
        return $keys;
    }
}

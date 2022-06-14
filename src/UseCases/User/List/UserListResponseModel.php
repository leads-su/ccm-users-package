<?php

namespace ConsulConfigManager\Users\UseCases\User\List;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

/**
 * Class UserListResponseModel
 * @package ConsulConfigManager\Users\UseCases\User\List
 */
class UserListResponseModel
{
    /**
     * Collection of entities
     * @var Collection|EloquentCollection|
     */
    private Collection|EloquentCollection $entities;

    /**
     * UserListResponseModel constructor.
     * @param Collection|EloquentCollection|array $entities
     * @return void
     */
    public function __construct(Collection|EloquentCollection|array $entities = [])
    {
        if (is_array($entities)) {
            $entities = collect($entities);
        }
        $this->entities = $entities;
    }

    /**
     * Get collection of entities
     * @return Collection|EloquentCollection
     */
    public function getEntities(): Collection|EloquentCollection
    {
        return $this->entities;
    }
}

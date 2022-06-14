<?php

namespace ConsulConfigManager\Users\UseCases\Token\List;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

/**
 * Class TokenListResponseModel
 * @package ConsulConfigManager\Users\UseCases\Token\List
 */
class TokenListResponseModel
{
    /**
     * Entities collection
     * @var Collection|EloquentCollection
     */
    private Collection|EloquentCollection $entities;

    /**
     * TokenListResponseModel constructor.
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
     * Get entities collection as array
     * @return array
     */
    public function getEntities(): array
    {
        return $this->entities->toArray();
    }
}

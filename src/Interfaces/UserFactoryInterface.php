<?php

namespace ConsulConfigManager\Users\Interfaces;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface UserFactoryInterface
 * @package ConsulConfigManager\Users\Interfaces
 */
interface UserFactoryInterface
{
    /**
     * Make new model from provided attributes
     * @param array $attributes
     * @param Model|null $parent
     * @return Model|UserInterface|null
     */
    public function make($attributes = [], ?Model $parent = null): Model|UserInterface|null;
}

<?php

namespace ConsulConfigManager\Users\Models;

use Illuminate\Support\Arr;
use Illuminate\Contracts\Support\Arrayable;
use LdapRecord\Models\ActiveDirectory\Entry;

/**
 * Class ADUser
 *
 * @package ConsulConfigManager\Users\Models
 */
class ADUser extends Entry implements Arrayable
{
    /**
     * @inheritDoc
     */
    public static $objectClasses = [
        'top',
        'person',
        'organizationalPerson',
        'user',
    ];

    /**
     * @inheritDoc
     */
    protected $hidden = [
        'objectclass',
        'objectguid',
        'objectsid',
    ];

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        $attributes = $this->attributes;
        foreach ($attributes as $key => $value) {
            if (in_array($key, $this->hidden)) {
                unset($attributes[$key]);
            } else {
                if (is_array($value) && count($value) === 1) {
                    $attributes[$key] = Arr::first($value);
                }
            }
        }
        return $attributes;
    }
}

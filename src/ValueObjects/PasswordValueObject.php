<?php

namespace ConsulConfigManager\Users\ValueObjects;

use DomainException;
use JsonSerializable;

/**
 * Class PasswordValueObject
 * @package ConsulConfigManager\Users\ValueObjects
 */
class PasswordValueObject implements JsonSerializable
{
    /**
     * Password validation regex
     * @var string
     */
    public const VALIDATION_REGEX = '/[,;:^*<>?"' . "'" . ']+/';

    /**
     * Password value
     * @var string
     */
    private string $value;

    /**
     * PasswordValueObject Constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        if (mb_strlen($value) < 8) {
            throw new DomainException('Password should be at least 8 characters long');
        }

        if (preg_match(self::VALIDATION_REGEX, $value)) {
            throw new DomainException('Your password contains characters use of which is forbidden');
        }

        $this->value = $value;
    }

    /**
     * Convert class to string representation
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * Get hashed representation of password
     * @return HashedPasswordValueObject
     */
    public function hashed(): HashedPasswordValueObject
    {
        return HashedPasswordValueObject::hash($this);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): string
    {
        return $this->value;
    }
}

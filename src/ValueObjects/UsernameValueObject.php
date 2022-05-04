<?php

namespace ConsulConfigManager\Users\ValueObjects;

use Stringable;
use DomainException;
use JsonSerializable;

/**
 * Class UsernameValueObject
 * @package ConsulConfigManager\Users\ValueObjects
 */
class UsernameValueObject implements JsonSerializable, Stringable
{
    /**
     * Username validation regex
     * @var string
     */
    public const VALIDATION_REGEX = "/\w{4,}/";

    /**
     * Username value
     * @var string
     */
    private string $value;

    /**
     * UsernameValueObject Constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => self::VALIDATION_REGEX]])) {
            throw new DomainException('Failed to validate username against regex.');
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
     * Check if provided E-Mail value object is equal to current
     * @param UsernameValueObject $usernameValueObject
     *
     * @return bool
     */
    public function isEqualTo(self $usernameValueObject): bool
    {
        return $this->value === $usernameValueObject->value;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): string
    {
        return $this->value;
    }
}

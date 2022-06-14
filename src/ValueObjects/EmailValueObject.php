<?php

namespace ConsulConfigManager\Users\ValueObjects;

use Stringable;
use DomainException;
use JsonSerializable;

/**
 * Class EmailValueObject
 * @package ConsulConfigManager\Users\ValueObjects
 */
class EmailValueObject implements JsonSerializable, Stringable
{
    /**
     * E-Mail value
     * @var string
     */
    private string $value;

    /**
     * EmailValueObject Constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new DomainException(sprintf(
                'Invalid E-Mail address - %s',
                $value
            ));
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
     * @param EmailValueObject $emailValueObject
     *
     * @return bool
     */
    public function isEqualTo(self $emailValueObject): bool
    {
        return $this->value === $emailValueObject->value;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): string
    {
        return $this->value;
    }
}

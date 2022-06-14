<?php

namespace ConsulConfigManager\Users\ValueObjects;

use DomainException;
use JsonSerializable;
use Illuminate\Support\Facades\Hash;

/**
 * Class HashedPasswordValueObject
 * @package ConsulConfigManager\Users\ValueObjects
 */
class HashedPasswordValueObject implements JsonSerializable
{
    /**
     * Hashed password value
     * @var string
     */
    private string $value;

    /**
     * HashedPasswordValueObject Constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $hashInformation = Hash::info($value);

        if (!isset($hashInformation['algo']) || $hashInformation['algoName'] === 'unknown') {
            throw new DomainException('Supplied value is not a hashed password.');
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
     * Check if provided hashed password value object is equal to current
     * @param HashedPasswordValueObject $hashedPasswordValueObject
     *
     * @return bool
     */
    public function isEqualTo(self $hashedPasswordValueObject): bool
    {
        return $this->value === $hashedPasswordValueObject->value;
    }

    /**
     * Check if provided password value object matches current password hash
     * @param PasswordValueObject $passwordValueObject
     *
     * @return bool
     */
    public function check(PasswordValueObject $passwordValueObject): bool
    {
        return Hash::check((string) $passwordValueObject, $this->value);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): string
    {
        return $this->value;
    }

    /**
     * Hash supplied password value object
     * @param PasswordValueObject $passwordValueObject
     *
     * @return static
     */
    public static function hash(PasswordValueObject $passwordValueObject): self
    {
        return new self(
            Hash::make((string) $passwordValueObject)
        );
    }
}

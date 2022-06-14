<?php

namespace ConsulConfigManager\Users\UseCases\Token\Delete;

use Illuminate\Http\Request;
use ConsulConfigManager\Users\Interfaces\UserInterface;

/**
 * Class TokenDeleteRequestModel
 * @package ConsulConfigManager\Users\UseCases\Token\Delete
 */
class TokenDeleteRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * Identifier reference
     * @var string|int
     */
    private string|int $identifier;

    /**
     * TokenDeleteRequestModel constructor.
     * @param Request $request
     * @param string|int $identifier
     * @return void
     */
    public function __construct(Request $request, string|int $identifier)
    {
        $this->request = $request;
        $this->identifier = $identifier;
    }

    /**
     * Get request instance
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * Get user instance
     * @return UserInterface|null
     */
    public function getUser(): ?UserInterface
    {
        return $this->getRequest()->user();
    }

    /**
     * Get identifier reference
     * @return string|int
     */
    public function getIdentifier(): string|int
    {
        return $this->identifier;
    }
}

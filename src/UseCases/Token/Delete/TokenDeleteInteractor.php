<?php

namespace ConsulConfigManager\Users\UseCases\Token\Delete;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class TokenDeleteInteractor
 * @package ConsulConfigManager\Users\UseCases\Token\Delete
 */
class TokenDeleteInteractor implements TokenDeleteInputPort
{
    /**
     * Output port instance
     * @var TokenDeleteOutputPort
     */
    private TokenDeleteOutputPort $output;

    /**
     * TokenDeleteInteractor constructor.
     * @param TokenDeleteOutputPort $output
     * @return void
     */
    public function __construct(TokenDeleteOutputPort $output)
    {
        $this->output = $output;
    }

    /**
     * @inheritDoc
     */
    public function delete(TokenDeleteRequestModel $requestModel): ViewModel
    {
        try {
            $user = $requestModel->getUser();
            $identifier = intval($requestModel->getIdentifier());

            if (!$user) {
                throw new ModelNotFoundException();
            }

            $tokenModel = null;

            foreach ($user->tokens as $token) {
                if ($token->id === $identifier) {
                    $tokenModel = $token;
                    break;
                }
            }

            if ($tokenModel === null) {
                throw new ModelNotFoundException();
            }

            $tokenModel->delete();

            return $this->output->delete(new TokenDeleteResponseModel($tokenModel));
        } catch (Throwable $throwable) {
            if ($throwable instanceof ModelNotFoundException) {
                return $this->output->notFound(new TokenDeleteResponseModel());
            }
            // @codeCoverageIgnoreStart
            return $this->output->internalServerError(new TokenDeleteResponseModel(), $throwable);
            // @codeCoverageIgnoreEnd
        }
    }
}

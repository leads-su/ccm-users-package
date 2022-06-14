<?php

namespace ConsulConfigManager\Users\UseCases\Token\List;

use Throwable;
use Illuminate\Support\Arr;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Class TokenListInteractor
 * @package ConsulConfigManager\Users\UseCases\Token\List
 */
class TokenListInteractor implements TokenListInputPort
{
    /**
     * Output port instance
     * @var TokenListOutputPort
     */
    private TokenListOutputPort $output;

    /**
     * TokenListInteractor constructor.
     * @param TokenListOutputPort $output
     * @return void
     */
    public function __construct(TokenListOutputPort $output)
    {
        $this->output = $output;
    }

    /**
     * @inheritDoc
     */
    public function list(TokenListRequestModel $requestModel): ViewModel
    {
        try {
            $user = $requestModel->getUser();
            $currentAccessToken = $user->currentAccessToken()->toArray();
            $tokens = [];

            foreach ($user->tokens->reverse()->toArray() as $token) {
                $isSameToken = Arr::get($currentAccessToken, 'id') === Arr::get($token, 'id');
                Arr::set($token, 'name', json_decode(Arr::get($token, 'name'), true));
                Arr::set($token, 'stringified', implode(' ', Arr::get($token, 'name')));
                Arr::set($token, 'current', $isSameToken);
                $tokens[] = $token;
            }

            return $this->output->list(new TokenListResponseModel($tokens));
            // @codeCoverageIgnoreStart
        } catch (Throwable $throwable) {
            return $this->output->internalServerError(new TokenListResponseModel(), $throwable);
        }
        // @codeCoverageIgnoreEnd
    }
}

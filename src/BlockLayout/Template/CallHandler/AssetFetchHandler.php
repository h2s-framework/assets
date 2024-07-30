<?php

namespace Siarko\Assets\BlockLayout\Template\CallHandler;

use Siarko\Assets\Api\AssetUrlProviderInterface;
use Siarko\BlockLayout\Template\CallHandler\CallHandlerInterface;
class AssetFetchHandler implements CallHandlerInterface
{

    /**
     * @param AssetUrlProviderInterface $urlProvider
     */
    public function __construct(
        private readonly AssetUrlProviderInterface $urlProvider,
    )
    {
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function handle(string $name, array $arguments = []): mixed
    {
        return $this->urlProvider->getFullAssetUrl($arguments[0]);
    }
}
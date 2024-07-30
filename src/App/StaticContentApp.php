<?php

namespace Siarko\Assets\App;

use Siarko\Assets\Api\Provide\AssetIdProviderInterface;
use Siarko\Assets\Api\Provide\AssetProviderInterface;
use Siarko\Assets\Api\Provide\AssetServerInterface;

class StaticContentApp implements \Siarko\Bootstrap\Api\AppInterface
{

    public const ASSET_URL_PREFIX = 'static';

    /**
     * @param AssetIdProviderInterface $assetIdProvider
     * @param AssetProviderInterface $assetProvider
     * @param AssetServerInterface $assetServer
     */
    public function __construct(
        private readonly AssetIdProviderInterface $assetIdProvider,
        private readonly AssetProviderInterface $assetProvider,
        private readonly AssetServerInterface $assetServer
    )
    {
    }

    /**
     * Start application
     *
     * @return void
     */
    public function start(): void
    {
        $assetId = $this->assetIdProvider->getAssetId();
        $asset = $this->assetProvider->getAsset($assetId);
        $this->assetServer->serveAsset($asset);
    }

    /**
     * Run sanity checks to ensure that application is properly configured
     *
     * @return void
     */
    public function runSanityChecks(): void
    {
        // TODO: Implement runSanityChecks() method.
    }

    /**
     * Handle errors
     *
     * @param \Throwable $exception
     * @return void
     */
    public function handleErrors(\Throwable $exception): void
    {
        $this->assetServer->serveAssetNotFound();
    }
}
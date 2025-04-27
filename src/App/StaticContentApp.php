<?php

namespace Siarko\Assets\App;

use Psr\Log\LoggerInterface;
use Siarko\Api\State\AppMode;
use Siarko\Api\State\AppStateInterface;
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
     * @param AppStateInterface $appState
     * @param LoggerInterface $logger
     */
    public function __construct(
        private readonly AssetIdProviderInterface $assetIdProvider,
        private readonly AssetProviderInterface $assetProvider,
        private readonly AssetServerInterface $assetServer,
        private readonly AppStateInterface $appState,
        private readonly LoggerInterface $logger
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
        if($this->appState->getAppMode() == AppMode::DEV){
           $this->serveErrorPage($exception);
        }else{
            $this->logger->error($exception->getMessage(), ['exception' => $exception]);
            $this->assetServer->serveAssetNotFound();
        }
    }

    /**
     * @param \Exception $exception
     * @param int $level
     * @return void
     */
    private function serveErrorPage(\Throwable $exception, int $level = 0): void
    {
        if($level === 0){
            http_response_code(500);
            echo "<h1>Error occured while serving asset</h1>";
        }else{
            echo "<h3>Previous error [{$level}]:</h3>";
        }
        echo "<p>{$exception->getMessage()}</p>";
        echo "<pre>{$exception->getTraceAsString()}</pre>";
        if(($previous = $exception->getPrevious())){
            $this->serveErrorPage($previous, ++$level);
        }
    }
}
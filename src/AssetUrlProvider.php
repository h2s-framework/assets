<?php

namespace Siarko\Assets;

use Siarko\Assets\Api\AssetIdConverterInterface;
use Siarko\Assets\Api\AssetUrlProviderInterface;
use Siarko\Assets\App\StaticContentApp;
use Siarko\Paths\Exception\RootPathNotSet;
use Siarko\UrlService\UrlProvider;
use Siarko\Utils\Strings;

class AssetUrlProvider implements AssetUrlProviderInterface
{

    /**
     * @param AssetIdConverterInterface $assetIdConverter
     * @param UrlProvider $urlProvider
     */
    public function __construct(
        private readonly AssetIdConverterInterface $assetIdConverter,
        private readonly UrlProvider $urlProvider
    )
    {
    }

    /**
     * @param string $assetId
     * @return string
     * @throws RootPathNotSet
     */
    public function getFullAssetUrl(string $assetId): string
    {
        return $this->urlProvider->getSubUrl([
            StaticContentApp::ASSET_URL_PREFIX,
            $this->assetIdConverter->getUrlFromId($assetId)
        ]);
    }

    /**
     * @param string $assetId
     * @return string
     */
    public function getRelativeAssetUrl(string $assetId): string
    {
        return Strings::createUrl([
            StaticContentApp::ASSET_URL_PREFIX,
            $this->assetIdConverter->getUrlFromId($assetId)
        ]);
    }
}
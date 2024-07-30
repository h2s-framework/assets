<?php

namespace Siarko\Assets\Provide;

use Siarko\Assets\Api\AssetIdConverterInterface;
use Siarko\Assets\Api\Provide\AssetIdProviderInterface;
use Siarko\UrlService\UrlProvider;

class AssetIdProvider implements AssetIdProviderInterface
{

    /**
     * @param UrlProvider $urlProvider
     * @param AssetIdConverterInterface $assetIdConverter
     */
    public function __construct(
        private readonly UrlProvider $urlProvider,
        private readonly AssetIdConverterInterface $assetIdConverter
    )
    {
    }

    /**
     * @return string
     */
    public function getAssetId(): string
    {
        $suffix = $this->urlProvider->getSuffix();
        return $this->assetIdConverter->getIdFromUrl($suffix);
    }

}
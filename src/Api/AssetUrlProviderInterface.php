<?php

namespace Siarko\Assets\Api;

interface AssetUrlProviderInterface
{

    /**
     * @param string $assetId
     * @return string
     */
    public function getFullAssetUrl(string $assetId): string;

    /**
     * @param string $assetId
     * @return string
     */
    public function getRelativeAssetUrl(string $assetId): string;
}

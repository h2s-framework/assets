<?php

namespace Siarko\Assets\Api\Provide;

use Siarko\Assets\Api\AssetInterface;

interface AssetProviderInterface
{

    /**
     * @param string $assetId
     * @return ?AssetInterface
     */
    public function getAsset(string $assetId): ?AssetInterface;

}
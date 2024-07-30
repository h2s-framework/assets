<?php

namespace Siarko\Assets\Api\Provide;

use Siarko\Assets\Api\AssetInterface;

interface AssetServerInterface
{

    /**
     * @param AssetInterface $asset
     * @return void
     */
    public function serveAsset(AssetInterface $asset): void;

    /**
     * @return void
     */
    public function serveAssetNotFound(): void;
}
<?php

namespace Siarko\Assets\Api\Provide;

interface AssetIdProviderInterface
{

    /**
     * @return string
     */
    public function getAssetId(): string;

}
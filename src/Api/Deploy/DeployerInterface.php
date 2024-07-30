<?php

namespace Siarko\Assets\Api\Deploy;

interface DeployerInterface
{

    /**
     * @param string $assetId
     * @return void
     */
    public function deploy(string $assetId): void;

}
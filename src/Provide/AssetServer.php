<?php

namespace Siarko\Assets\Provide;

use Siarko\Assets\Api\AssetInterface;
use Siarko\Assets\Api\Provide\AssetServerInterface;

class AssetServer implements AssetServerInterface
{

    /**
     * @param AssetInterface $asset
     * @return void
     */
    public function serveAsset(AssetInterface $asset): void
    {
        $mime = $asset->getMimeType();
        header('Content-Type: '.$mime);
        readfile($asset->getFile()->getPath());
    }

    /**
     * @return void
     */
    public function serveAssetNotFound(): void
    {
        header('HTTP/1.0 404 Not Found');
        echo '404 Not Found';
    }
}
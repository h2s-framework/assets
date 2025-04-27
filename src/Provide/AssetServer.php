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
        header('Cache-Control: no-store, no-cache, max-age=0');
        readfile($asset->getFile()->getPath());
    }

    /**
     * @return void
     */
    public function serveAssetNotFound(): void
    {
        http_response_code(404);
        echo '404 Asset Not Found';
    }
}
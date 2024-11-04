<?php

namespace Siarko\Assets\Exception;

use JetBrains\PhpStorm\Pure;

class AssetFileNotFoundException extends \Exception
{
    /**
     * Construct the exception. Note: The message is NOT binary safe.
     * @link https://php.net/manual/en/exception.construct.php
     * @param string $assetId
     * @param string $filePath
     */
    #[Pure] public function __construct(string $assetId, string $filePath)
    {
        parent::__construct("Asset file not found: $assetId ($filePath)");
    }


}
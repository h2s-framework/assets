<?php

namespace Siarko\Assets\Api;

use Siarko\Files\Api\FileInterface;

interface AssetInterface
{

    /**
     * @return string
     */
    public function getMimeType(): string;

    /**
     * @return FileInterface
     */
    public function getFile(): FileInterface;

    /**
     * @return string
     */
    public function getId(): string;

}
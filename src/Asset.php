<?php

namespace Siarko\Assets;

use Siarko\Assets\Api\AssetInterface;
use Siarko\Assets\Exception\AssetMimeTypeUnknownException;
use Siarko\Files\Api\FileInterface;

class Asset implements AssetInterface
{

    public function __construct(
        private readonly FileInterface $file,
        private readonly string $id
    )
    {
    }

    /**
     * @return string
     * @throws AssetMimeTypeUnknownException
     */
    public function getMimeType(): string
    {
        $mimes = $this->file->getMimeTypes();
        if(empty($mimes)){
            throw new AssetMimeTypeUnknownException($this->id);
        }
        return $mimes[0];
    }

    /**
     * @return FileInterface
     */
    public function getFile(): FileInterface
    {
        return $this->file;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }


}
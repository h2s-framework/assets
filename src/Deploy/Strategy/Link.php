<?php

namespace Siarko\Assets\Deploy\Strategy;

use Siarko\Assets\Api\Deploy\DeploymentStrategyInterface;
use Siarko\Files\Api\DirectoryInterface;
use Siarko\Files\Api\FileInterface;
use Siarko\Files\Api\Persistence\FilePersistenceInterface;

class Link implements DeploymentStrategyInterface
{

    /**
     * @param FilePersistenceInterface $filePersistence
     */
    public function __construct(
        private readonly FilePersistenceInterface $filePersistence
    )
    {
    }

    /**
     * @param FileInterface $file
     * @param DirectoryInterface $targetDirectory
     * @return void
     */
    public function executeDeployment(FileInterface $file, DirectoryInterface $targetDirectory): void
    {
        $this->filePersistence->softLink($file, $targetDirectory);
    }
}
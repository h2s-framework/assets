<?php

namespace Siarko\Assets\Deploy\Strategy;

use Siarko\Files\Api\DirectoryInterface;
use Siarko\Files\Api\FileInterface;
use Siarko\Files\Api\Persistence\FilePersistenceInterface;

class Copy implements \Siarko\Assets\Api\Deploy\DeploymentStrategyInterface
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
        $this->filePersistence->copy($file, $targetDirectory);
    }
}
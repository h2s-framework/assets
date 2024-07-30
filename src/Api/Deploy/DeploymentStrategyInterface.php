<?php

namespace Siarko\Assets\Api\Deploy;

use Siarko\Files\Api\DirectoryInterface;
use Siarko\Files\Api\FileInterface;

interface DeploymentStrategyInterface
{

    /**
     * @param FileInterface $file
     * @param DirectoryInterface $targetDirectory
     * @return void
     */
    public function executeDeployment(FileInterface $file, DirectoryInterface $targetDirectory): void;
}
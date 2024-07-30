<?php

namespace Siarko\Assets\Deploy;

use Siarko\Assets\Api\AssetIdConverterInterface;
use Siarko\Assets\Api\Deploy\DeployerInterface;
use Siarko\Assets\Api\Deploy\DeploymentStrategyManagerInterface;
use Siarko\Files\Api\DirectoryInterface;
use Siarko\Files\Api\FileInterfaceFactory;

class AssetDeployer implements DeployerInterface
{

    /**
     * @param DirectoryInterface $targetDirectory
     * @param FileInterfaceFactory $fileFactory
     * @param AssetIdConverterInterface $assetIdConverter
     * @param DeploymentStrategyManagerInterface $deploymentStrategy
     */
    public function __construct(
        private readonly DirectoryInterface $targetDirectory,
        private readonly FileInterfaceFactory $fileFactory,
        private readonly AssetIdConverterInterface $assetIdConverter,
        private readonly DeploymentStrategyManagerInterface $deploymentStrategy
    )
    {
    }

    /**
     * @param string $assetId
     * @return void
     */
    public function deploy(string $assetId): void
    {
        $deployPath = $this->assetIdConverter->getLocalPathFromId($assetId);
        $localPath = $this->assetIdConverter->getModulePathFromId($assetId);
        $this->copyAsset($localPath, $deployPath);
    }

    /**
     * @param string $absolutePath
     * @param string $deployLocalPath
     * @return void
     */
    private function copyAsset(string $absolutePath, string $deployLocalPath): void
    {
        $newDirectory = $this->targetDirectory->subdirectory(dirname($deployLocalPath));
        $file = $this->fileFactory->create();
        $file->setPath($absolutePath);
        $this->deploymentStrategy->getStrategyDecision()->executeDeployment($file, $newDirectory);
    }
}
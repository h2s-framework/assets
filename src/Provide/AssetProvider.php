<?php

namespace Siarko\Assets\Provide;

use Siarko\Assets\Api\AssetIdConverterInterface;
use Siarko\Assets\Api\AssetInterface;
use Siarko\Assets\Api\AssetInterfaceFactory;
use Siarko\Assets\Api\Deploy\DeployerInterface;
use Siarko\Assets\Api\Provide\AssetProviderInterface;
use Siarko\Assets\Exception\AssetFileNotFoundException;
use Siarko\Files\Api\DirectoryInterface;
use Siarko\Files\Api\FileInterface;
use Siarko\Files\Api\FileInterfaceFactory;

/**
 * Class AssetProvider
 * Used to provide assets from directory by static server
 * */
class AssetProvider implements AssetProviderInterface
{

    /**
     * @param DirectoryInterface $assetsDirectory
     * @param FileInterfaceFactory $fileFactory
     * @param AssetInterfaceFactory $assetFactory
     * @param DeployerInterface $deployer
     * @param AssetIdConverterInterface $assetIdConverter
     */
    public function __construct(
        private readonly DirectoryInterface $assetsDirectory,
        private readonly FileInterfaceFactory $fileFactory,
        private readonly AssetInterfaceFactory $assetFactory,
        private readonly DeployerInterface $deployer,
        private readonly AssetIdConverterInterface $assetIdConverter
    )
    {
    }

    /**
     * @param string $assetId
     * @return ?AssetInterface
     * @throws AssetFileNotFoundException
     */
    public function getAsset(string $assetId): ?AssetInterface
    {
        $this->deployer->deploy($assetId);
        $file = $this->getFile($assetId);
        return $this->assetFactory->create([
            'file' => $file,
            'id' => $assetId,
        ]);
    }

    /**
     * @param string $assetId
     * @return FileInterface|null
     * @throws AssetFileNotFoundException
     */
    private function getFile(string $assetId): ?FileInterface
    {
        $deployedPath = $this->assetIdConverter->getLocalPathFromId($assetId);
        $filePath = $this->assetsDirectory->getFilePath($deployedPath);
        $file = $this->fileFactory->create();
        $file->setPath($filePath);
        if(!$file->exists()){
            throw new AssetFileNotFoundException($assetId, $filePath);
        }
        return $file;
    }

}
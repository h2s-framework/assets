<?php

namespace Siarko\Assets;

use Siarko\Assets\Api\AssetIdConverterInterface;
use Siarko\Assets\Exception\AssetPathNotFoundException;
use Siarko\Assets\Exception\InvalidAssetUrlException;
use Siarko\Paths\Api\Provider\Pool\PathProviderPoolInterface;
use Siarko\Utils\Strings;

class AssetIdConverter implements AssetIdConverterInterface
{

    /**
     * @param PathProviderPoolInterface $modulePathProvider
     */
    public function __construct(
        private readonly PathProviderPoolInterface $modulePathProvider
    )
    {
    }

    /**
     * @param string $url
     * @return string
     * @throws InvalidAssetUrlException
     */
    public function getIdFromUrl(string $url): string
    {
        if($this->isModuleAssetUrl($url)){
            return $this->getModuleIdFromUrl($url);
        }
        return '';
    }

    /**
     * @param string $id
     * @return string
     * @throws AssetPathNotFoundException
     */
    public function getUrlFromId(string $id): string
    {
        if($this->isModuleAssetId($id)){
            return $this->getModuleAssetUrl($id);
        }
        return Strings::urlEncode($id);
    }

    /**
     * @param string $id
     * @return string
     * @throws AssetPathNotFoundException
     */
    public function getLocalPathFromId(string $id): string
    {
        if ($this->isModuleAssetId($id)) {
            return $this->getModuleAssetPath($id);
        }
        return $id;
    }

    /**
     * @param string $id
     * @return string
     * @throws AssetPathNotFoundException
     */
    public function getModulePathFromId(string $id): string
    {
        $providers = $this->modulePathProvider->getProviders(self::PATH_PROVIDER_TYPE);
        foreach ($providers as $provider) {
            if($path = $provider->getConstructedPath($id)){
                return $path;
            }
        }
        throw new AssetPathNotFoundException($id);
    }

    /**
     * @param string $url
     * @return bool
     */
    public function isModuleAssetUrl(string $url): bool
    {
        return str_starts_with($url, self::MODULE_PREFIX);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function isModuleAssetId(string $id): bool
    {
        return str_contains($id, self::MODULE_SEPARATOR);
    }

    /**
     * @param string $url
     * @return string
     * @throws InvalidAssetUrlException
     */
    private function getModuleIdFromUrl(string $url): string
    {
        $url = Strings::urlDecode($url);
        $parts = explode(Strings::URL_SEPARATOR, $url);
        if(count($parts) < 2){
            throw new InvalidAssetUrlException($url);
        }
        array_shift($parts);
        $moduleId = ucwords(str_replace('__', '.', array_shift($parts)), '.');
        $moduleId = Strings::snakeCaseToCamelCase($moduleId, true);
        return $moduleId . self::MODULE_SEPARATOR . implode(Strings::URL_SEPARATOR, $parts);

    }

    /**
     * @param string $id
     * @return string
     * @throws AssetPathNotFoundException
     */
    private function getModuleAssetUrl(string $id): string
    {
        [$moduleId, $assetPath] = explode(self::MODULE_SEPARATOR, $id);
        if(empty($moduleId) || empty($assetPath)){
            throw new AssetPathNotFoundException($id);
        }
        $moduleId = Strings::camelCaseToSnakeCase($moduleId);
        return Strings::createUrl([self::MODULE_PREFIX, $moduleId, $assetPath]);
    }

    /**
     * @param string $id
     * @return string
     * @throws AssetPathNotFoundException
     */
    private function getModuleAssetPath(string $id): string
    {
        [$moduleId, $assetPath] = explode(self::MODULE_SEPARATOR, $id);
        if(empty($moduleId) || empty($assetPath)){
            throw new AssetPathNotFoundException($id);
        }
        $moduleId = Strings::camelCaseToSnakeCase(str_replace('.', '_', $moduleId));
        return Strings::createPath([self::MODULE_PREFIX, $moduleId, Strings::urlToPath($assetPath)]);
    }
}
<?php

namespace Siarko\Assets\Api;

interface AssetIdConverterInterface
{
    public const MODULE_SEPARATOR = '::';
    public const MODULE_PREFIX = 'module';

    public const PATH_PROVIDER_TYPE = 'assets';

    /**
     * @param string $url
     * @return string
     */
    public function getIdFromUrl(string $url): string;

    /**
     * @param string $id
     * @return string
     */
    public function getUrlFromId(string $id): string;

    /**
     * @param string $id
     * @return string
     */
    public function getLocalPathFromId(string $id): string;

    /**
     * Return module relative path to asset
     * @param string $id
     * @return string
     */
    public function getModulePathFromId(string $id): string;

}
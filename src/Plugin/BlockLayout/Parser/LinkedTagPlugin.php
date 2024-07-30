<?php

namespace Siarko\Assets\Plugin\BlockLayout\Parser;

use Siarko\Assets\Api\AssetIdConverterInterface;
use Siarko\Assets\Api\AssetUrlProviderInterface;
use Siarko\BlockLayout\Definitions\Builtin\AbstractLinkedTag;
use Siarko\BlockLayout\Definitions\TagData;
use Siarko\Plugins\Config\Attribute\PluginMethod;

class LinkedTagPlugin
{

    public function __construct(
        private readonly AssetUrlProviderInterface $assetUrlProvider
    )
    {
    }

    #[PluginMethod]
    public function afterParse(AbstractLinkedTag $subject, TagData $result, \SimpleXMLElement $element): TagData
    {
        if($element->attributes()->asset){
            $assetId = $element->attributes()->asset->__toString();
            $result->addExtraData('href', $this->assetUrlProvider->getFullAssetUrl($assetId));
        }
        return $result;
    }
}
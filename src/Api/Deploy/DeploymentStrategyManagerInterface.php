<?php

namespace Siarko\Assets\Api\Deploy;

interface DeploymentStrategyManagerInterface
{

    /**
     * @return DeploymentStrategyInterface
     */
    public function getStrategyDecision(): DeploymentStrategyInterface;
}
<?php

namespace Siarko\Assets\Api\Deploy;

interface DeploymentStrategyPoolInterface
{

    /**
     * @param string $strategyClass
     * @return DeploymentStrategyInterface
     */
    public function getStrategy(string $strategyClass): DeploymentStrategyInterface;
}
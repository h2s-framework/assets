<?php

namespace Siarko\Assets\Deploy;

use Siarko\Assets\Api\Deploy\DeploymentStrategyInterface;
use Siarko\Assets\Api\Deploy\DeploymentStrategyPoolInterface;
use Siarko\Assets\Exception\DeploymentStrategyNotFound;

class DeploymentStrategyPool implements DeploymentStrategyPoolInterface
{

    /**
     * @param DeploymentStrategyInterface[] $strategies
     */
    public function __construct(
        private readonly array $strategies = []
    )
    {
    }

    /**
     * @param string $strategyClass
     * @return DeploymentStrategyInterface
     * @throws DeploymentStrategyNotFound
     */
    public function getStrategy(string $strategyClass): DeploymentStrategyInterface
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy instanceof $strategyClass) {
                return $strategy;
            }
        }
        throw new DeploymentStrategyNotFound($strategyClass);
    }
}
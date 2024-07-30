<?php

namespace Siarko\Assets\Deploy;

use Siarko\Api\State\AppMode;
use Siarko\Api\State\AppState;
use Siarko\Assets\Api\Deploy\DeploymentStrategyInterface;
use Siarko\Assets\Api\Deploy\DeploymentStrategyManagerInterface;
use Siarko\Assets\Api\Deploy\DeploymentStrategyPoolInterface;
use Siarko\Assets\Deploy\Strategy\Copy;
use Siarko\Assets\Deploy\Strategy\Link;

class DeploymentStrategyManager implements DeploymentStrategyManagerInterface
{

    /**
     * @param DeploymentStrategyPoolInterface $strategyPool
     * @param AppState $appState
     */
    public function __construct(
        private readonly DeploymentStrategyPoolInterface $strategyPool,
        private readonly AppState $appState
    )
    {
    }

    /**
     * @return DeploymentStrategyInterface
     */
    public function getStrategyDecision(): DeploymentStrategyInterface
    {
        return match ($this->appState->getAppMode()) {
            AppMode::DEV => $this->strategyPool->getStrategy(Link::class),
            default => $this->strategyPool->getStrategy(Copy::class),
        };
    }
}
<?php

namespace Siarko\Assets\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AssetDeployment extends Command
{
    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('deploy:assets')
            ->setDescription("Deploy static assets to public directory");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        return 0;
    }


}
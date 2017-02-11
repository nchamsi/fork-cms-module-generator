<?php

namespace ModuleGenerator\ModuleGenerator\Settings\Console;

use ModuleGenerator\ModuleGenerator\Settings\Settings;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class ResetSettings extends Command
{
    /** @var Settings */
    private $settings;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('settings:reset')
            ->setDescription('Reset the settings to the default settings');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->settings->reset();
    }
}

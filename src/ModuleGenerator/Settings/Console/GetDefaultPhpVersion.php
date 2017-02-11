<?php

namespace ModuleGenerator\ModuleGenerator\Settings\Console;

use ModuleGenerator\ModuleGenerator\Settings\Settings;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class GetDefaultPhpVersion extends Command
{
    /** @var Settings The service to interact with the settings */
    private $settings;

    /**
     * @param Settings $settings
     */
    public function __construct(Settings $settings)
    {
        $this->settings = $settings;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('settings:get:default-php-version')
            ->setDescription('Gets the default php version');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(number_format($this->settings->get(Settings::DEFAULT_PHP_VERSION), 1));
    }
}

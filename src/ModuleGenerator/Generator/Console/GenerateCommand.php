<?php

namespace ModuleGenerator\ModuleGenerator\Generator\Console;

use ModuleGenerator\ModuleGenerator\Generator\Generator;
use ModuleGenerator\ModuleGenerator\Settings\Settings;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class GenerateCommand extends Command
{
    /** @var Generator */
    protected $generator;

    /** @var Settings */
    protected $settings;

    /** @var InputInterface */
    private $input;

    /** @var OutputInterface */
    private static $output;

    /** @var float */
    private $targetPhpVersion;

    protected function configure()
    {
        $this->addArgument(
            'php',
            InputArgument::OPTIONAL,
            'Target PHP version',
            $this->getSettings()->get(Settings::DEFAULT_PHP_VERSION)
        );
    }

    /**
     * @param Generator $generator
     * @param Settings $settings
     */
    public function __construct(Generator $generator, Settings $settings)
    {
        $this->generator = $generator;
        $this->settings = $settings;
        parent::__construct();
    }

    /**
     * @return Settings
     */
    protected function getSettings()
    {
        return $this->settings;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        self::$output = $output;

        $this->targetPhpVersion = (float) $this->input->getArgument('php');
        if (!in_array($this->targetPhpVersion, $this->getSettings()->get(Settings::SUPPORTED_PHP_VERSIONS), true)) {
            throw new InvalidArgumentException(
                'This php version is not available as a target. The possible options are: ' . implode(
                    ', ',
                    $this->getSettings()->get(Settings::SUPPORTED_PHP_VERSIONS)
                )
            );
        }
    }

    public function getTargetPhpVersion(): float
    {
        return $this->targetPhpVersion;
    }

    public function getFormData(string $className, array $options = [], $data = null)
    {
        $formHelper = $this->getHelper('form');

        return $formHelper->interactUsingForm($className, $this->input, self::$output, $options, $data);
    }

    /**
     * Yes I know it is dirty but it works for now
     *
     * @return OutputInterface
     */
    public static function getOutput()
    {
        return self::$output;
    }
}

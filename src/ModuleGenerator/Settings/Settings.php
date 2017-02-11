<?php

namespace ModuleGenerator\ModuleGenerator\Settings;

use InvalidArgumentException;
use Symfony\Component\Yaml\Yaml;

final class Settings
{
    // setting keys
    const SUPPORTED_PHP_VERSIONS = 'SUPPORTED_PHP_VERSIONS';
    const DEFAULT_PHP_VERSION = 'DEFAULT_PHP_VERSION';

    /**
     * Array cache for the settings
     *
     * @var array
     */
    private $settings = [];

    /**
     * Location of the yml file that stores the settings
     *
     * @var string
     */
    private $settingsCacheFile;

    /**
     * @param string $settingsCacheFile The location of the file where the settings are permanently stored
     */
    public function __construct(string $settingsCacheFile)
    {
        $this->settingsCacheFile = $settingsCacheFile;

        if (file_exists($this->settingsCacheFile)) {
            $this->load();

            return;
        }

        // If the file doesn't exist, load the defaults
        $this->reset();
    }

    /**
     * @param string $setting The name of the setting, use one of the constants defined at the top
     *                        of this class to make sure you always will get the correct setting.
     *
     * @throws SettingNotFound when the setting does not exist
     *
     * @return mixed The value of the setting
     */
    public function get(string $setting)
    {
        if (!array_key_exists($setting, $this->settings)) {
            throw new SettingNotFound($setting);
        }

        return $this->settings[$setting];
    }

    /**
     * @param string $setting The name of the setting, use one of the constants defined at the top
     *                        of this class to make sure you always will get the correct setting.
     * @param mixed $value The value of the setting
     *
     * @throws InvalidArgumentException When you try to overwrite the supported php versions, that one is set in stone
     */
    public function set(string $setting, $value)
    {
        if ($setting === self::SUPPORTED_PHP_VERSIONS) {
            throw new InvalidArgumentException('You can\'t overwrite the supported PHP versions');
        }

        $this->settings[$setting] = $value;

        $this->save();
    }

    /**
     * Restore the default settings and save them to the settings file.
     */
    public function reset()
    {
        $this->settings = [
            self::SUPPORTED_PHP_VERSIONS => [
                5.6,
                7.0,
            ],
            self::DEFAULT_PHP_VERSION => 7.0,
        ];

        $this->save();
    }

    /**
     * Load the settings from the settings file
     */
    private function load()
    {
        $this->settings = (array) Yaml::parse(file_get_contents($this->settingsCacheFile));
        // just make sure that this is up to date
        $this->settings[self::SUPPORTED_PHP_VERSIONS] = [
            5.6,
            7.0,
        ];
    }

    /**
     * Save the settings to the settings file
     */
    private function save()
    {
        file_put_contents($this->settingsCacheFile, Yaml::dump($this->settings));
    }
}

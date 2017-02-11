<?php

namespace ModuleGenerator\ModuleGenerator\Settings;

use Exception;

/**
 * This exception is thrown when a setting that doesn't exist is requested
 */
final class SettingNotFound extends Exception
{
    /**
     * @param string $setting
     *
     * @return self
     */
    public static function forSetting($setting)
    {
        return new self('The setting ' . $setting . ' could not be found');
    }
}

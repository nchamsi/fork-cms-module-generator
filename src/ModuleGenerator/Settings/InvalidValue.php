<?php

namespace ModuleGenerator\ModuleGenerator\Settings;

use Exception;

/**
 * This exception is thrown when a setting that doesn't exist is requested
 */
final class InvalidValue extends Exception
{
    /**
     * @param string $setting
     *
     * @return self
     */
    public static function forSetting($setting)
    {
        return new self(
            sprintf('The setting %1$s was passed an invalid value', $setting)
        );
    }

    /**
     * @param string $setting
     * @param string $message
     *
     * @return self
     */
    public static function forSettingAndMessage($setting, $message)
    {
        return new self(
            sprintf('The setting %1$s was passed an invalid value and returned the message: %2$s', $setting, $message)
        );
    }
}

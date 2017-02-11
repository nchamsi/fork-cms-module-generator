<?php

namespace ModuleGenerator\ModuleGenerator\Settings;

use Exception;

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

<?php

namespace ModuleGenerator\ModuleGenerator\Settings\Validator;

use ModuleGenerator\ModuleGenerator\Settings\InvalidValue;
use ModuleGenerator\ModuleGenerator\Settings\Settings;

final class DefaultPhpVersion implements Validator
{
    public static function validate(Settings $settings, string $setting, $value)
    {
        if (!in_array($value, $settings->get(Settings::SUPPORTED_PHP_VERSIONS))) {
            throw InvalidValue::forSettingAndMessage(
                $setting,
                'PHP versions needs to be one of the allowed versions: ' . implode(
                    ', ',
                    $settings->get(Settings::SUPPORTED_PHP_VERSIONS)
                )
            );
        }
    }
}

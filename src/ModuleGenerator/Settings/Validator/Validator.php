<?php

namespace ModuleGenerator\ModuleGenerator\Settings\Validator;

use ModuleGenerator\ModuleGenerator\Settings\InvalidValue;
use ModuleGenerator\ModuleGenerator\Settings\Settings;

interface Validator
{
    /**
     * @param Settings $settings
     * @param string $setting
     * @param mixed $value
     *
     * @throws InvalidValue when the value isn't valid
     */
    public static function validate(Settings $settings, string $setting, $value);
}

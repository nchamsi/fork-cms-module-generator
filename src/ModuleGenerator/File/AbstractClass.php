<?php

namespace ModuleGenerator\ModuleGenerator\File;

use ModuleGenerator\PhpGenerator\ClassName\ClassName;

abstract class AbstractClass
{
    abstract public function getClassName(): ClassName;

    public function getTemplatePath(float $targetPhpVersion): string
    {
        return realpath(
            __DIR__ . '/../../src/' . preg_replace(
                '/^ModuleGenerator/',
                '',
                str_replace('\\', '/', static::class) . '.php' . $targetPhpVersion * 10 . '.php.twig'
            )
        );
    }
}

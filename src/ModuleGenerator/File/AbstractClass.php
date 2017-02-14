<?php

namespace ModuleGenerator\ModuleGenerator\File;

use ModuleGenerator\PhpGenerator\ClassName\ClassName;

abstract class AbstractClass extends AbstractFile
{
    const TEMPLATE_KEY = 'class';

    /**
     * @return ClassName
     */
    abstract public function getClassName(): ClassName;

    /**
     * @param float $targetPhpVersion
     *
     * @return string
     */
    public function getFilePath(float $targetPhpVersion): string
    {
        $fileDirectory = str_replace('\\', '/', $this->getClassName()->getNamespace()->getName());

        return $fileDirectory . '/' . $this->getClassName()->getName() . '.php';
    }

    /**
     * @param float $targetPhpVersion
     *
     * @return string
     */
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

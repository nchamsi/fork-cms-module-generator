<?php

namespace ModuleGenerator\ModuleGenerator\File;

abstract class AbstractFile
{
    const TEMPLATE_KEY = 'file';

    /**
     * @param float $targetPhpVersion
     *
     * @return string
     */
    abstract public function getFilePath(float $targetPhpVersion): string;

    /**
     * @param float $targetPhpVersion
     *
     * @return string
     */
    abstract public function getTemplatePath(float $targetPhpVersion): string;
}

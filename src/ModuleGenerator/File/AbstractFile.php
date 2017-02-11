<?php

namespace ModuleGenerator\ModuleGenerator\File;

abstract class AbstractFile
{
    abstract public function getFilePath(float $targetPhpVersion): string;
    abstract public function getTemplatePath(float $targetPhpVersion): string;
}

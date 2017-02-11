<?php

namespace ModuleGenerator\ModuleGenerator\ContentDumper;

use Symfony\Component\Filesystem\Filesystem;

final class FilesystemContentDumper implements ContentDumper
{
    /** @var Filesystem */
    private $fileSystem;

    public function __construct()
    {
        $this->fileSystem = new Filesystem();
    }

    public function dump(string $filename, string $content)
    {
        $this->fileSystem->dumpFile($filename, $content);
    }
}

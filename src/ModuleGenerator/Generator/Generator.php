<?php

namespace ModuleGenerator\ModuleGenerator\Generator;

use ModuleGenerator\ModuleGenerator\ContentDumper\ContentDumper;
use ModuleGenerator\ModuleGenerator\File\AbstractFile;
use Symfony\Bundle\TwigBundle\TwigEngine;

final class Generator
{
    /** @var string the directory where the command was executed */
    protected $currentWorkingDirectory;

    /** @var string the src directory */
    private $generateDirectory;

    /** @var TwigEngine */
    private $templating;

    /** @var ContentDumper */
    private $contentDumper;

    /**
     * @param TwigEngine $templating
     * @param ContentDumper $contentDumper
     */
    public function __construct(TwigEngine $templating, ContentDumper $contentDumper)
    {
        $this->currentWorkingDirectory = getcwd();
        $this->templating = $templating;
        $this->contentDumper = $contentDumper;
    }

    /**
     * @throws SrcDirectoryNotFound
     *
     * @return string The src directory
     */
    private function getGenerateDirectory()
    {
        if ($this->generateDirectory !== null) {
            return $this->generateDirectory;
        }

        $currentDirectory = $this->currentWorkingDirectory;

        // Is this the src directory? Or any of the above directories?
        while ($currentDirectory !== '/') {
            // Is this the src directory?
            if (basename($currentDirectory) === 'src') {
                return $this->generateDirectory = $currentDirectory;
            }
            // Does this directory contain the src directory?
            if (is_dir($currentDirectory . '/src')) {
                return $this->generateDirectory = $currentDirectory . '/src';
            }

            // Try in the parent directory
            $currentDirectory = dirname($currentDirectory);
        }

        throw SrcDirectoryNotFound::forDirectory($this->currentWorkingDirectory);
    }

    /**
     * @param AbstractFile $file
     * @param float $targetPhpVersion
     */
    public function generate(AbstractFile $file, float $targetPhpVersion)
    {
        $this->generateMultiple([$file], $targetPhpVersion);
    }

    /**
     * @param AbstractFile[] $files
     * @param float $targetPhpVersion
     */
    public function generateMultiple(array $files, float $targetPhpVersion)
    {
        array_map(
            function (AbstractFile $file) use ($targetPhpVersion) {
                $this->contentDumper->dump(
                    $this->getGenerateDirectory() . '/' . $file->getFilePath($targetPhpVersion),
                    $this->templating->render(
                        $file->getTemplatePath($targetPhpVersion),
                        [$file::TEMPLATE_KEY => $file]
                    )
                );
            },
            $files
        );
    }
}

<?php

namespace ModuleGenerator\ModuleGenerator\ContentDumper;

interface ContentDumper
{
    public function dump(string $filename, string $content);
}

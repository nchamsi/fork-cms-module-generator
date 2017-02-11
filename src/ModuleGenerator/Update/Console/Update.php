<?php

namespace ModuleGenerator\ModuleGenerator\Update\Console;

use Symfony\Component\Console\Command\Command;
use ModuleGenerator\ModuleGenerator\Update\Update as UpdateService;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Update extends Command
{
    /** @var UpdateService */
    protected $update;

    public function __construct(UpdateService $update)
    {
        parent::__construct();

        $this->update = $update;
    }

    protected function configure()
    {
        $this->setName('self:update')
            ->setDescription('Updates the module-generator');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->update->run();
    }
}

<?php

namespace Standalone;

use Standalone\MyTestEntityRepository;

final class DeleteMyTestEntityHandler
{
    /** @var MyTestEntityRepository */
    private $myTestEntityRepository;

    /**
     * @param MyTestEntityRepository $myTestEntityRepository
     */
    public function __construct(MyTestEntityRepository $myTestEntityRepository)
    {
        $this->myTestEntityRepository = $myTestEntityRepository;
    }

    /**
     * @param DeleteMyTestEntity $deleteMyTestEntity
     */
    public function handle(DeleteMyTestEntity $deleteMyTestEntity)
    {
        $this->myTestEntityRepository->remove($deleteMyTestEntity->getMyTestEntity());
    }
}
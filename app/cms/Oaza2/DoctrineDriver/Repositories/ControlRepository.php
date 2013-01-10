<?php

namespace OazaCMS\Oaza2\Repositories;

use Oaza\Application\Adapter\ControlRepository\IControlRepository;
use Oaza\Application\Adapter\ControlRepository\IControlEntity;
use Doctrine\ORM\EntityRepository;

class ControlRepository implements IControlRepository
{

    private $doctrineRepository;
    public function __construct(EntityRepository $doctrineRepository) {
        $this->doctrineRepository = $doctrineRepository;
    }

    /**
     * Returns entity for control by name.
     * @param string $controlName
     * @return IControlEntity
     */
    public function getControlEntity($controlName)
    {
        return $this->doctrineRepository->findOneBy(array('name'=>$controlName));
    }

    /**
     * Remove control entity from application
     * @param $controlEntity
     * @return IControlRepository
     */
    public function delete(IControlEntity $controlEntity)
    {
    }
}

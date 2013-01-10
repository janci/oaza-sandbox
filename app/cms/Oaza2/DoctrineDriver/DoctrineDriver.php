<?php

namespace OazaCMS\Oaza2\DoctrineDriver;

use Oaza\Application\Adapter\Drivers\DummyDriver\DummyDriver;
use Oaza\Application\Adapter\IDriver;
use OazaCMS\Oaza2\Repositories\ControlRepository;

class DoctrineDriver extends DummyDriver /* implements IDriver */
{

    private $entityManager;

    private $controlRepository;

    private $routeRepository;

    public function __construct(\Doctrine\ORM\EntityManager $entityManager){
        $this->entityManager = $entityManager;
    }

    /**
     * Returns Control Repository implement in driver
     * @return \Oaza\Application\Adapter\ControlRepository\IControlRepository
     */
    public function getControlRepository()
    {
        return isset($this->controlRepository)? $this->controlRepository :
            $this->controlRepository = new ControlRepository($this->entityManager->getRepository('OazaCMS\Oaza2\DoctrineDriver\Entities\ControlEntity'));
    }

    /**
     * Returns Translate Repository implement in driver
     * @return \Oaza\Application\Adapter\TranslateRepository\ITranslateRepository
     */
    /*public function getTranslateRepository()
    {
        return isset($this->translateRepository)? $this->translateRepository :
            $this->translateRepository = new TranslateRepository($this->entityManager->getRepository('Translate'));
    } */

    /**
     * Returns Router Repository implement in driver
     * @return \Oaza\Application\Adapter\RouteRepository\IRouteRepository
     */
    /*public function getRouteRepository()
    {
        return isset($this->routeRepository)? $this->routeRepository :
            $this->routeRepository = new TranslateRepository($this->entityManager->getRepository('OazaCMS\Oaza2\DoctrineDriver\Entities\RouteEntity'));
    } */
}

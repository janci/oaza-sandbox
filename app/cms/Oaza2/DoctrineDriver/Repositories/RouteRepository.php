<?php

namespace OazaCMS\Oaza2\Repositories;

use \Doctrine\ORM\EntityRepository;
use \Oaza\Application\Adapter\RouteRepository\IRouteRepository;

class RouteRepository implements IRouteRepository
{
    /** @var \Doctrine\ORM\EntityRepository */
    private $doctrineRepository;

    public function __construct(EntityRepository $doctrineRepository) {
        $this->doctrineRepository = $doctrineRepository;
    }

    /**
     * Returns entity by path
     *
     * @param $path string
     * @param $params string
     * @return Page | NULL
     */
    public function getRouteEntity($path, $params=null){
        $entity = $this->doctrineRepository->findOneBy(array('path'=>$path));
        return ($entity==false)? null:$entity;
    }

    /**
     * Returns entity by id
     *
     * @param $id int
     * @return Page | NULL
     */
    public function findRouteEntity($id){
        $entity = $this->doctrineRepository->find($id);
        return ($entity==false)? null:$entity;

    }

    /**
     * Returns new route by old route id - use for expired links
     *
     * @param $oldRouteId int
     * @return Page | NULL
     */
    public function findNewRoute($oldRouteId){
        $entity = $this->doctrineRepository->findOneBy(array('previous'=>$oldRouteId));
        return ($entity==false)? null:$entity;
    }

}

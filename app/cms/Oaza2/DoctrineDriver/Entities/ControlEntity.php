<?php
namespace OazaCMS\Oaza2\DoctrineDriver\Entities;

use Oaza\Application\Adapter\ControlRepository\IControlEntity;

class ControlEntity implements IControlEntity
{
    private $id;

    private $name;

    private $className;

    private $properties;

    /**
     * Returns control classname
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    public function getName(){
        return $this->name;
    }

    /**
     * Returns control properties
     * @return array
     */
    public function getProperties()
    {
        return json_decode( $this->properties );
    }
}

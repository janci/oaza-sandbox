<?php

namespace OazaCMS\Extensions;

use \Oaza\Application\Adapter\ControlRepository\IControlRepository;
use Oaza\Application\UI\Presenter;

abstract class BaseExtension extends \Oaza\Object
{
    private $config;

    /** @var string */
    private $workDirectory;

    /** @var array */
    private $builders = array();

    /** @var IControlRepository */
    private $controlRepository;

    /** @var \BasePresenter */
    private $presenter;

    public function getTemplateBuilders(){
        return $this->builders;
    }

    public function addTemplateBuilder($name, \ITemplateBuilder $builder){
        $this->builders[$name] = $builder;
    }

    public function getWorkDirectory(){
        if(isset($this->workDirectory)) return $this->workDirectory;
        return $this->workDirectory = dirname($this->getReflection()->getFileName());
    }

    public function getConfigFileName() {
        return $this->getWorkDirectory() . DIRECTORY_SEPARATOR . 'config.json';
    }

    public function  getConfig(){
        if(isset($this->config)) return $this->config;

        $configFilename = $this->getConfigFileName();
        if(!file_exists($configFilename))
            throw new ExtensionException("Missing file with configuration: {$configFilename}.");

        return $this->config = json_decode(file_get_contents($configFilename));
    }

    public function getTitle(){
        return $this->getConfig()->title;
    }

    public function getName(){
        return $this->getConfig()->name;
    }

    public function inject(IControlRepository $controlRepository, Presenter $presenter) {
        $this->controlRepository = $controlRepository;
        $this->presenter = $presenter;
    }

    /**
     * Returns doctrine entity manager
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager(){
        return $this->presenter->getEntityManager();
    }

    public function getControl($controlName) {
        /* @var $control \Oaza\Application\UI\Widget */
        $control = $this->presenter->getComponent($controlName, false);
        if(!isset($control)) return null;

        return $control;
    }

    public function load(){

    }

    public function install() {

    }

    public function uninstall() {

    }

}

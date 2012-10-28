<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application;

/**
 * Abstract Oaza presenter
 */
abstract class Presenter extends \Nette\Application\UI\Presenter
{
    /** @var array */
    private $oazaControls;

    /** @var array */
    private $oazaControlsProperties;

    /**
     * Sets oaza controls for autoloading
     * @param $controls
     * @param array $properties
     */
    final public function setOazaControls($controls, $properties=array()){
        $this->oazaControls = $controls;
        $this->oazaControlsProperties = $properties;
    }

    /**
     * Autoloading components
     * @param $name
     * @return \Nette\ComponentModel\IComponent|void
     */
    public function createComponent($name){
        $control = parent::createComponent($name);
        if(isset($control)) return $control;

        if(isset($this->oazaControls, $this->oazaControls[$name])) {
            $classname = $this->oazaControls[$name];
            $control = new $classname;
            if($control instanceof Control){
                $control->startup();
                $control->startupCheck();
                $control->settingMode();

                if(isset($this->oazaControlsProperties, $this->oazaControlsProperties[$name]))
                    $control->setPropertiesValues($this->oazaControlsProperties[$name]);

                $control->load();
            }
            return $control;
        }
    }

}

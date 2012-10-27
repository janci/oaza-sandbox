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
    /**
     * Autoloading components
     * @param $name
     * @return \Nette\ComponentModel\IComponent|void
     */
    public function createComponent($name){
        $control = parent::createComponent($name);
        if(isset($control)) return $control;
    }

}

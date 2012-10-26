<?php
/**
 * This file is part of the Oaza Framework (http://nette.org)
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza\Application;

use Oaza\Setting\Property;
use Oaza\Setting\PropertyType;


/**
 *  Abstract class for rendered controls by oaza
 *
 *  @author     Jan Svantner
 */
abstract class Widget extends Control
{
    /**
     * Initialize render component
     */
    public function startup(){
        parent::startup();

        $this->addProperty(new Property( PropertyType::INT, 'min-width', 0, false ));
        $this->addProperty(new Property( PropertyType::INT, 'min-height', 0, false ));

        $currentDirectory = dirname($this->getReflection()->getFileName());
        $this->template->setFile($currentDirectory.DIRECTORY_SEPARATOR."template.latte");
    }

    /**
     * Render template
     * @param array|null $params
     */
    public function render($params=null){
        $this->template->render();
    }
}

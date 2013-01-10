<?php
/**
 * This file is part of the Oaza CMS
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace OazaCMS\Extensions\Core\Widgets\LeftBlock;

use Oaza\Setting\Property;
use Oaza\Setting\PropertyType;
use IBuildControl;


/**
 * Sample example for oaza control
 *
 * @author  Jan Svantner
 */
class LeftBlock extends \Oaza\Application\UI\Widget implements IBuildControl
{

    public function startup(){
        parent::startup();

        $this->getProperty('min-width')->setValue(50);
        $this->getProperty('min-height')->setValue(50);

        $this->addProperty(new Property(PropertyType::INT, "width", "20"));
        $this->addProperty(new Property(PropertyType::INT, "height", ""));
        $this->addProperty(new Property(PropertyType::STRING, "margin", "0px 0px 0px 0px"));
        $this->addProperty(new Property(PropertyType::STRING, "padding", "0px 0px 0px 0px"));
        $this->addProperty(new Property(PropertyType::STRING, "border", "none"));
        $this->addProperty(new Property(PropertyType::STRING, "background", "transparent"));


    }
    public function attached($presenter) {
        parent::attached($presenter);

        $this->container->addStyle('width', $this->getProperty('width') . 'px');
        $this->container->addStyle('background', $this->getProperty('background'));

        if($this->getProperty('height')!="")
            $this->container->addStyle('height', $this->getProperty('height') . 'px');

        $this->container->addStyle('float', 'left');
        $this->container->addStyle('border', $this->getProperty('border'));
        $this->container->addStyle('margin', $this->getProperty('margin'));
        $this->container->addStyle('padding', $this->getProperty('padding'));
    }

    public function begin()
    {
        $this->container->addClass('widget');
        return $this->container->startTag();
    }

    public function end()
    {
        return $this->container->endTag();
    }

}
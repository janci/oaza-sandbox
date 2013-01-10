<?php
/**
 * This file is part of the Oaza CMS
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace OazaCMS\Extensions\Core\Widgets\Menu;

use Oaza\Setting\Property;
use Oaza\Setting\PropertyType;
use IBuildControl;
use Nette\Utils\Html;


/**
 * Sample example for oaza control
 *
 * @author  Jan Svantner
 */
class Menu extends \Oaza\Application\UI\Widget implements IBuildControl
{

    public function startup(){
        parent::startup();

        $this->addProperty(new Property(PropertyType::INT, "width", ""));
        $this->addProperty(new Property(PropertyType::INT, "height", ""));
        $this->addProperty(new Property(PropertyType::STRING, "margin", "0px 0px 0px 0px"));
        $this->addProperty(new Property(PropertyType::STRING, "padding", "0px 0px 0px 0px"));
        $this->addProperty(new Property(PropertyType::STRING, "border", "none"));
        $this->addProperty(new Property(PropertyType::STRING, "background", "transparent"));
        $this->addProperty(new Property(PropertyType::STRING, "font-size", "normal"));

        $this->addProperty(new Property(PropertyType::STRING, "name", "main"));


    }
    public function attached($presenter) {
        parent::attached($presenter);

        if($this->getProperty('width')!="")
            $this->container->addStyle('width', $this->getProperty('width') . 'px');

        $this->container->addStyle('background', $this->getProperty('background'));

        if($this->getProperty('height')!="")
            $this->container->addStyle('height', $this->getProperty('height') . 'px');

        $this->container->addStyle('text-align', $this->getProperty('align'));
        $this->container->addStyle('border', $this->getProperty('border'));
        $this->container->addStyle('margin', $this->getProperty('margin'));
        $this->container->addStyle('padding', $this->getProperty('padding'));
        $this->container->addStyle('font-size', $this->getProperty('font-size'));
    }

    public function begin()
    {
        $this->container->addClass('widget');
        $sep = $this->getProperty('separator');
        $year = ($this->getProperty('created') == date('Y'))? $this->getProperty('created'):$this->getProperty('created').$sep.date('Y');

        return $this->container->startTag().
            Html::el('span')->setText($year)->addClass('year').' '.
            $this->getProperty('company');
    }

    public function end(){
        return "";
    }


}
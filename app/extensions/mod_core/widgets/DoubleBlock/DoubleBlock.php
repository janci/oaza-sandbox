<?php
/**
 * This file is part of the Oaza CMS
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace OazaCMS\Extensions\Core\Widgets\DoubleBlock;

use Oaza\Setting\Property;
use Oaza\Setting\PropertyType;
use IBuildControl;
use Nette\Utils\Html;


/**
 * Sample example for oaza control
 *
 * @author  Jan Svantner
 */
class DoubleBlock extends \Oaza\Application\UI\Widget implements IBuildControl
{
    protected $containerEntity;
    protected $elementEntity;
    protected $commandName;


    public function startup(){
        parent::startup();

        $this->getProperty('min-width')->setValue(50);
        $this->getProperty('min-height')->setValue(50);

        $this->containerEntity = Html::el('div');
        $this->elementEntity = Html::el('div');

        $this->container->add($this->containerEntity);
        $this->containerEntity->add($this->elementEntity);

        $this->addProperty(new Property(PropertyType::INT, "width", "960"));
        $this->addProperty(new Property(PropertyType::INT, "height", ""));
        $this->addProperty(new Property(PropertyType::STRING, "background", "transparent"));
        $this->addProperty(new Property(PropertyType::STRING, "outer-background", "transparent"));

        $this->addProperty(new Property(PropertyType::STRING, "margin", "0px 0px 0px 0px"));
        $this->addProperty(new Property(PropertyType::STRING, "padding", "0px 0px 0px 0px"));
        $this->addProperty(new Property(PropertyType::STRING, "border", "none"));


    }
    public function attached($presenter) {
        parent::attached($presenter);

        $this->commandName = $this->getName();
        $this->elementEntity->addClass('inner-box');
        $this->containerEntity->addClass('parent-'.$this->commandName);
        $this->elementEntity->addClass('child-'.$this->commandName);

        $this->elementEntity->addStyle('width', $this->getProperty('width') . 'px');
        $this->elementEntity->addStyle('background', $this->getProperty('background'));

        $this->containerEntity->addStyle('background', $this->getProperty('outer-background'));

        if($this->getProperty('height')!="")
            $this->elementEntity->addStyle('height', $this->getProperty('height') . 'px');

        $this->elementEntity->addStyle('margin', 'auto');
        $this->elementEntity->addStyle('border', $this->getProperty('border'));
        $this->elementEntity->addStyle('padding', $this->getProperty('padding'));
    }

    public function begin()
    {
        $this->container->addClass('widget');
        return $this->container->startTag() . $this->containerEntity->startTag() . $this->elementEntity->startTag();
    }

    public function end()
    {
        return $this->container->endTag() . $this->containerEntity->endTag() . $this->elementEntity->endTag();
    }

}
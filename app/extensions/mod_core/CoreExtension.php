<?php

namespace OazaCMS\Extensions;

use DoubleBlockBuilder;
use ControlBuilder;
use ClearBlockBuilder;

class CoreExtension extends BaseExtension
{

    public function load(){
        $blocks = array('header', 'footer', 'wrapper', 'leftpanel');
        foreach ($blocks as $block) {
            $control = $this->getControl('c'.$block);
            if(isset($control))
                $this->addTemplateBuilder($block, new ControlBuilder($control) );
        }
        $this->addTemplateBuilder('clear', new ClearBlockBuilder());
    }

}

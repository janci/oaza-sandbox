<?php

namespace OazaCMS\Extensions;

use Setting;
use ControlBuilder;

class MenuExtension extends BaseExtension
{

    public function load() {
        $control = $this->getControl('menu');
        if(isset($control))
            $this->addTemplateBuilder('menu', new ControlBuilder($control) );
    }

}

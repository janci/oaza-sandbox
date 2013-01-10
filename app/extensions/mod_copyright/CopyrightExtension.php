<?php

namespace OazaCMS\Extensions;

use Setting;
use ControlBuilder;

class CopyrightExtension extends BaseExtension
{

    public function load() {
        $control = $this->getControl('copyright');
        if(isset($control))
            $this->addTemplateBuilder('copyright', new ControlBuilder($control) );
    }

}

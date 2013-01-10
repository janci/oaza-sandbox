<?php

class ControlBuilder  implements ITemplateBuilder
{
    private $control;

    public function __construct(IBuildControl $control) {
        $this->control = $control;
    }

    public function buildBegin($command, $parameters = null)
    {
        return $this->control->begin();
    }

    public function buildEnd($command)
    {
        return $this->control->end();
    }
}

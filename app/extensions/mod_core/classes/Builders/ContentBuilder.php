<?php

class ContentBuilder  implements ITemplateBuilder
{
    private $content;

    public function __construct($content) {
        $this->content = $content;
    }

    public function buildBegin($command, $parameters = null)
    {
        return $this->content;
    }

    public function buildEnd($command)
    {
        return "";
    }
}

<?php

use \Nette\Utils\Html;

class DoubleBlockBuilder  implements ITemplateBuilder
{
    private $element='div';
    private $parent='div';

    public function __construct($replaceElement='div', $parentElement="div") {
        $this->element = Html::el($replaceElement);
        $this->parent = Html::el($parentElement);
    }

    public function buildBegin($command, $parameters = null)
    {
        $this->parent->addClass('parent-'.$command);
        $this->element->addClass('child-'.$command);
        $this->element->addClass('inner-box');
        return $this->parent->startTag() . $this->element->startTag();
    }

    public function buildEnd($command)
    {
        return $this->element->endTag() . $this->parent->endTag();
    }
}

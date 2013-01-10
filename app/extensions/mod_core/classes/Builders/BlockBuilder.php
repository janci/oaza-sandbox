<?php

use \Nette\Utils\Html;

class BlockBuilder  implements ITemplateBuilder
{
    protected  $replaceElement='div';

    public function __construct($replaceElement='div') {
        $this->replaceElement = Html::el($replaceElement);
    }

    public function buildBegin($command, $parameters = null)
    {
        $this->replaceElement->addAttributes($parameters);
        return $this->replaceElement->startTag();
    }

    public function buildEnd($command)
    {
        return $this->replaceElement->endTag();
    }
}

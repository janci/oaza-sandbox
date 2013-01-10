<?php

use \Nette\Utils\Html;

class ClearBlockBuilder  extends BlockBuilder
{

    public function buildBegin($command, $parameters = null)
    {
        $this->replaceElement->addAttributes($parameters);
        $this->replaceElement->addStyle('clear','both');
        return $this->replaceElement->startTag();
    }

}

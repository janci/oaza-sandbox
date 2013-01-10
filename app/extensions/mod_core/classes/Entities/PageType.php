<?php

class PageType
{
    /** @var integer */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $presenter;

    /** @var string */
    private $module;

    /** @var string */
    private $action;

    /** @var Page[] */
    private $pages;

    /** @var Template */
    private $template;


    /**
     * Return page type template
     * @return Template
     */
    public function getTemplate(){
        return $this->template;
    }

}

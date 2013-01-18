<?php

use \Oaza\Application\Adapter\RouteRepository\IRouteEntity;

class Page implements IRouteEntity
{
    private $id;

    private $page_id;

    private $path;

    private $expire;

    private $previous;

    private $title;

    private $description;

    private $keywords;

    private $followed;

    private $indexed;


    /** @var PageType */
    private $type;

    /**
     * Return type of page
     * @return PageType
     */
    public function getPageType(){
        return $this->type;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getModule()
    {
        return $this->getPageType()->getModule();
    }

    public function getPresenter()
    {
        return $this->getPageType()->getPresenter();
    }

    public function getAction()
    {
        return $this->getPageType()->getAction();
    }

    public function getPageId()
    {
        return $this->id;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getExpireDate()
    {
        return $this->expire;
    }
}

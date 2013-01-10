<?php


class Page
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

}

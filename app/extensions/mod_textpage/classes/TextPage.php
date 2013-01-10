<?php


class TextPage
{
    /** @var integer */
    private $id;

    /** @var string */
    private $content;

    /** @var Page */
    private $page;

    /**
     * Returns content of page
     * @return string
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Sets page
     * @param Page $page
     */
    public function setPage(Page $page){
        $this->page = $page;
    }

    /**
     * Returns page object for current text page
     * @return Page
     */
    public function getPage(){
        return $this->page;
    }

}

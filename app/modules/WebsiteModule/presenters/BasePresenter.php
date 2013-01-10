<?php
namespace WebsiteModule;

class BasePresenter extends \BasePresenter
{
    public function formatLayoutTemplateFiles() {
        $files = parent::formatLayoutTemplateFiles();
        $files[] = realpath( __DIR__ . '/../templates/'.$this->getName().'/@layout.latte' );
        $files[] = realpath( __DIR__ . '/../templates/@layout.latte' );
        return $files;
    }

}

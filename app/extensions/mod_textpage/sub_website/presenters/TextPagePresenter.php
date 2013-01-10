<?php

namespace WebsiteModule;

class TextPagePresenter extends BasePresenter
{
    private $text;
    private $title;

    public function actionDefault(){
        $page = $this->getEntityManager()->getRepository('Page')->find($this->getCurrentPageId());

        /* @var $testRep \TextPage */
        $testRep = $this->getEntityManager()->getRepository('TextPage')->findOneBy(array('page'=>$page));
        if($testRep==false)  {
            throw new \Nette\Application\BadRequestException("Missing text page with for `page_id` is ". $this->getCurrentPageId());
        }

        $template = $testRep->getPage()->getPageType()->getTemplate();
        $content = $testRep->getContent();

        if(isset($template)) $this->applyTemplateBuilders($template);
        $this->text = isset($template)? $template->buildHtml($content) : $content;
        $this->title = $testRep->getPage()->getTitle();
    }

    public function renderDefault(){
        $this->template->text = $this->text;
        $this->template->title = $this->title;
    }
}

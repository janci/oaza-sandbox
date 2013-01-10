<?php

use Nette\DI\Container as DIContainer;
use Oaza\Oaza;
use Nette\Localization\ITranslator;
use Doctrine\ORM\EntityManager as EM;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends \Oaza\Application\UI\Presenter
{
    private $entityManager;

    private $pluginsByName;

    private $pluginsByClassName;

    private $extensionBuilders = array();


    public function __construct(DIContainer $context, Oaza $oaza, EM $entityManager, ITranslator $translator = null){
        parent::__construct($context, $oaza, $translator);
        $this->entityManager = $entityManager;
    }

    public function getEntityManager() {
        return $this->entityManager;
    }

    public function loadPlugins() {
        $this->loadPlugin('\OazaCMS\Extensions\CoreExtension');

        $extensionRepository = $this->getEntityManager()->getRepository('Extension');
        $extensions = $extensionRepository->findBy(array('enable'=>true));
        foreach($extensions as $extension) {
            $extensionClassName = $extension->getClassName();
            $this->loadPlugin($extensionClassName);
        }
    }

    private function loadPlugin($extensionClassName) {
        if(isset($this->pluginsByClassName[$extensionClassName])) return;

        /* @var $ext \OazaCMS\Extensions\BaseExtension */
        $ext = new $extensionClassName;
        if(!($ext instanceof \OazaCMS\Extensions\BaseExtension))
            throw new \OazaCMS\Extensions\ExtensionException("Extension must extend BaseExtension for correct load.");

        $this->pluginsByName[$ext->getName()] = $ext;
        $this->pluginsByClassName[$extensionClassName] = $ext;
        $ext->inject($this->oaza->getDatabaseAdapter()->getControlRepository(), $this);
        $ext->load();

        $this->extensionBuilders = array_merge($this->extensionBuilders, $ext->getTemplateBuilders());
    }

    public function applyTemplateBuilders(Template $template) {
        $template->builders['block'] = new BlockBuilder();
        $template->builders = array_merge($template->builders, $this->extensionBuilders);
    }

    public function startup() {
        parent::startup();
        $this->loadPlugins();
    }

    public function setPageTitle($title) {
        $this->template->title = $title;
    }
}

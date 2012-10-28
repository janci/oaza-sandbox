<?php

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends \Oaza\Application\Presenter
{
   public function startup(){
       parent::startup();

       $controls = array(
           'demo' => '\Oaza\Sample\HelloWorld\HelloWorld'
       );

       $properties = array(
           'demo' => array(
               'text' => 'Lorem Ipsum Demo Text'
           )
       );

       $this->setOazaControls($controls, $properties);
   }

}

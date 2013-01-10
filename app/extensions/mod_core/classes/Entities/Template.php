<?php

class Template
{
    /** @var integer */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $template;

    /** @var PageType[] */
    private $pagesTypes;


    /**
     * @use $builders[$commandName] = new ITemplateBuilder();
     * @var ITemplateBuilder[]
     */
    public $builders;

    /**
     * Return template as string
     * @return string
     */
    public function getTemplate(){
        return  $this->template;
    }

    /**
     * return html content for layout
     * @param $content
     * @return string
     */
    public function buildHtml($content){
        $t = $this->template;
        $t = str_replace('<', '&lt;', $t);
        $t = str_replace('>', '&gt;', $t);

        preg_match_all('#\{([\/]?)([a-zA-Z0-9\-]+)( ?)([^\}\/]*)([\/]?)\}#', $t, $commands);
        $this->builders['content'] = new ContentBuilder($content);

        $layout = "";
        if(isset($commands['2']))
            foreach($commands['2'] as $iterator=>$command) {
                if(isset($this->builders[$command])) {
                    $builder = $this->builders[$command];
                    if($builder instanceof ITemplateBuilder) {
                        $parameters = str_replace('  ', ' ', $commands['4'][$iterator]); //strip white space
                        $parameters = empty($parameters)? array(): explode(' ',$parameters);
                        if($parameters != array() ) {
                            $parameters2 = array();
                            foreach($parameters as $iterator => $parameter) {
                                list( $paramName, $paramValue ) = explode('=', $parameter);
                                if(isset($paramValue)) {
                                    $paramValue = str_replace('"','', $paramValue);
                                    $paramValue = str_replace("'",'', $paramValue);

                                    $parameters2[$paramName] = $paramValue;
                                }
                            }
                        } else {
                            $parameters2 = array();
                        }

                        if($commands['1'][$iterator] != '/')
                            $layout .= $builder->buildBegin($command, $parameters2);
                        if($commands['5'][$iterator] == '/' || $commands['1'][$iterator] == '/')
                            $layout .= $builder->buildEnd($command);
                    }
                }
            }

        return $layout;
    }

}
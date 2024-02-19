<?php
class TemplateEngine
{
    protected $template;
    protected $data;
    protected $mustache;

    function __construct($template='default.mst',$data=[]){
        $this->template = $template;
        $this->data=$data;
        // use .mst instead of .mustache for default template extension
        $options =  array('extension' => '.mst');

        $this->mustache = new Mustache_Engine(array(
            
            'loader' => new Mustache_Loader_FilesystemLoader(BASE_PATH . '/templates',$options),
            'partials_loader' => new Mustache_Loader_FilesystemLoader(BASE_PATH . '/templates',$options),
        ));
    }

    function setData($myData){
        $this->data=$myData;
    }

    function set($var,$html){
        $this->data[$var][]=$html;
    }

    function render(){        
        return $this->mustache->render($this->template, $this->data);
    }
}
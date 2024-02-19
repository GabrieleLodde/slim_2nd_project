<?php
class AlunnoPage extends TemplateEngine
{
    
    function __construct($template="alunno.mst", $data=[]){
        parent::__construct($template, $this->data);
    }

}
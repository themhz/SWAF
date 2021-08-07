<?php

namespace SampleWebApp\components;

class View
{

   
    public function __construct()
    {
        
    }

    public function render($layout = 'main', $view = "", $params=[]){

        $layoutContent = $this->layout($layout, $params);
        
        $viewContent = $this->view($view, $params);
                
        return str_replace('{{VIEW}}', $viewContent, $layoutContent);
    }

    protected function layout($layout = 'main', $params){
        foreach($params as $key => $value){
            $$key = $value;
        }   
        ob_start();        
        include_once "views/layouts/$layout.php";        
        return ob_get_clean();
    }

    protected function view($view, $params){
        foreach($params as $key => $value){
            $$key = $value;
        }   
        ob_start();        
        include_once "views/publicPages/$view/view.php";        
        return ob_get_clean();
    }

    
}

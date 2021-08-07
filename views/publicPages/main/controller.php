<?php
namespace SampleWebApp\views\publicPages\main;
use SampleWebApp\components\Controller as baseController;
use SampleWebApp\components\View;

class Controller extends baseController{
    
    public function __construct($app) {
        parent::__construct($app);
    }

    public function post(){        
        
        $params = $this->app->body();
        $view = new view($this->app);
        echo $view->render('main', $this->app->path() , $params);
    }

    public function get(){
        $params = $this->app->body();
        $view = new view($this->app);
        echo $view->render('main', $this->app->path() , $params);
    }

    public function put(){
        echo "put";
    }

    public function delete(){
        echo "delete";
    }
}
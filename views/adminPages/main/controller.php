<?php
namespace SampleWebApp\views\adminPages\main;
use SampleWebApp\components\Controller as baseController;
use SampleWebApp\components\View;

class Controller extends baseController{
    
    public function __construct($app) {
        parent::__construct($app);
    }

    public function post(){        
        
      
    }

    public function get(){
        echo "main";
        // $params = $this->app->body();
        // $view = new view($this->request->app);
        // echo $view->render('main', $this->app->request->path() , $params);
    }

    public function put(){
        echo "put";
    }

    public function delete(){
        echo "delete";
    }
}
 
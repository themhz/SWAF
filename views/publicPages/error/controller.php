<?php
namespace swaf\views\publicPages\error;
use swaf\components\core\Controller as baseController;
use swaf\components\core\View;

class Controller extends baseController{
    
    public function __construct($app) {
        parent::__construct($app);
    }

    public function post(){        
        
        $params = ['error'=> $this->app->error] + $this->app->request->body();
        $view = new view($this->app);
        echo $view->render('main', 'error' , $params);
    }

    public function get(){
        $params = ['error'=>  $this->app->error] + $this->app->request->body();
        $view = new view($this->app);
        echo $view->render('main', 'error' , $params);
    }

    public function put(){
        echo "put";
    }

    public function delete(){
        echo "delete";
    }
    
}
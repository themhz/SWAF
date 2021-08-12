<?php
namespace swaf\views\publicPages\register;
use swaf\components\core\Controller as baseController;
use swaf\components\core\View;

class Controller extends baseController{
    public function __construct($app) {
        parent::__construct($app);
    }


    public function post(){
        echo "login post";
    }

    public function get(){
        //echo "this is the products";
        

                        
        $view = new view($this->app->request);
        echo $view->render('main', 'register', []);
    }

    public function put(){
        echo "put";
    }

    public function delete(){
        echo "delete";
    }
}
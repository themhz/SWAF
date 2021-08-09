<?php
namespace SampleWebApp\views\adminPages\products;
use SampleWebApp\components\Controller as baseController;
use SampleWebApp\components\View;

class Controller extends baseController{
    
    public function __construct($app) {
        parent::__construct($app);
    }

    public function post(){        
        
        echo "products";
    }

    public function get(){
        echo "products";
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
 
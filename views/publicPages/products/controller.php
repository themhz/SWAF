<?php
namespace swaf\views\publicPages\products;
use swaf\components\core\Controller as baseController;
use swaf\components\core\View;
use swaf\models\Products;

class Controller extends baseController{
    
    public function __construct($app) {
        parent::__construct($app);
    }

    public function post(){        
        
        echo "this is the products";
        $p = new Products();

        print_r($p->select());
        // $params = $this->app->request->body();
        // $view = new view($this->app);
        // echo $view->render('main', $this->app->request->path() , $params);
    }

    public function get(){
        //echo "this is the products";
         $p = new Products();

        
        
         $products = $p->select();
        
        // //$params = $this->app->request->body();
        // //echo "<pre>";
        // //print_r($products);
        // //echo "<pre>";
        //  //die();
         $view = new view($this->app->request);
         echo $view->render('main', $this->app->request->path() , $products);
    }

    public function put(){
        echo "put";
    }

    public function delete(){
        echo "delete";
    }
}
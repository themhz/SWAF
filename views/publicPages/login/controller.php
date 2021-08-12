<?php

namespace swaf\views\publicPages\login;

use swaf\components\core\Controller as baseController;
use swaf\components\core\View;
use swaf\components\handlers\UserRegister;

class Controller extends baseController
{
    public function __construct($app)
    {
        parent::__construct($app);
    }

    public function post()
    {


        //print_r($this->app->request->body());
        //$register = new UserRegister();
        // $params = $this->app->body();
        // print_r($this->app->session->get("user"));
        // die();
        $view = new view($this->app);
        echo $view->render('main', 'main', $this->app->session->get("user"));
    }

    public function get()
    {
        $this->isLogout();
        $view = new view();
        echo $view->render('main', 'login', []);
    }

    public function put()
    {
        echo "put";
    }

    public function delete()
    {
        echo "delete";
    }


    public function isLogout()
    {       
        $params = (object)$this->app->request->body();
           
        if (isset($params->logout) && $params->logout == 1) {
            $this->app->session->clear();
            header('Location: ' . 'main');            
        }
    }
}

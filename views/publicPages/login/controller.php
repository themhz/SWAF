<?php

namespace swaf\views\publicPages\login;

use swaf\components\core\Controller as baseController;
use swaf\components\core\View;
use swaf\components\handlers\Session;

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

        //  echo '<pre>';
        //   print_r($this->app->session['userdetails']);
        // //  print_r($_SESSION);
        //   echo '<pre>';
        //   die();
        
        $view = new view($this->app);
        echo $view->render('main', 'main', $this->app->session['userdetails']);
    }

    public function get()
    {

        $this->checkLogout();
      
         $view = new view();
         echo $view->render('main', 'login', [], 'public');
    }

    public function put()
    {
        echo "put";
    }

    public function delete()
    {
        echo "delete";
    }


    public function checkLogout()
    {       
        $params = (object)$this->app->request->body();
        
        if (isset($params->logout) && $params->logout == 1) {
            $session = new Session();
            $session->clear();
            header('Location: ' . 'main');
        }
    }
}

<?php
namespace swaf\views\adminPages\main;
use swaf\components\core\Controller as baseController;
use swaf\components\core\View;
use swaf\components\core\FileUploader;


class Controller extends baseController{
    
    public function __construct($app) {
        parent::__construct($app);
    }

    public function post()
    {        
        // $target_dir = $this->app->rootpath . DIRECTORY_SEPARATOR . 'SampleWebApp/views/' . DIRECTORY_SEPARATOR . 'publicPages' . DIRECTORY_SEPARATOR . 'userfiles' . DIRECTORY_SEPARATOR;
        // $fileUploader = new FileUploader($target_dir);
        // $fileUploader->multiupload();
        
         $view = new view($this->app->request);
         //echo $this->app->request->path();
        echo $view->render('main', 'main', [], 'admin');

    }

    public function get()
    {

        $view = new view($this->app->request);
        echo $view->render('main', 'main', [], 'admin');
    }


    public function put(){
        echo "put";
    }

    public function delete(){
        echo "delete";
    }
}
 
<?php

namespace swaf\views\publicPages\main;

use swaf\components\core\Controller as baseController;
use swaf\components\core\View;
use swaf\components\handlers\FileUploader;

use SampleWebApp\models\Products;

class Controller extends baseController
{

    public function __construct($app)
    {
        parent::__construct($app);
    }

    public function post()
    {
        $target_dir = $this->app->rootpath . DIRECTORY_SEPARATOR . 'SampleWebApp' . DIRECTORY_SEPARATOR . 'userfiles' . DIRECTORY_SEPARATOR;
        $fileUploader = new FileUploader($target_dir);
        $fileUploader->multiupload();
        
    }

    public function get()
    {
        
        $view = new view($this->app->request);
        
        echo $view->render('main', 'main', [], 'public');
    }

    public function put()
    {
        echo "put";
    }

    public function delete()
    {
        echo "delete";
    }
}

<?php

namespace SampleWebApp\views\publicPages\main;

use SampleWebApp\components\Controller as baseController;
use SampleWebApp\components\View;
use SampleWebApp\components\FileUploader;

use SampleWebApp\models\Products;

class Controller extends baseController
{

    public function __construct($app)
    {
        parent::__construct($app);
    }

    public function post()
    {
        $target_dir = $this->app->rootpath . DIRECTORY_SEPARATOR . 'SampleWebApp/views/' . DIRECTORY_SEPARATOR . 'publicPages' . DIRECTORY_SEPARATOR . 'userfiles' . DIRECTORY_SEPARATOR;
        $fileUploader = new FileUploader($target_dir);
        $fileUploader->multiupload();
        
    }

    public function get()
    {

        $view = new view($this->app->request);
        echo $view->render('main', $this->app->request->path(), []);
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

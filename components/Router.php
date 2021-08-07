<?php

namespace SampleWebApp\components;

use SampleWebApp\components\Http;
use SampleWebApp\components\View;


class Router
{

    public App $app;
    protected array $routes = [];

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function resolve()
    {
        $path = $this->app->path();               
        $method = $this->app->method();
                
        try {
            $class = '\SampleWebApp\views\publicPages\\' . $path . '\Controller';            
            $controller = new $class($this->app);
            $controller->$method();

         } catch (\Throwable $e) {
            
            $this->app->response->setStatusCode(404);
            $class = '\SampleWebApp\views\publicPages\error\Controller';
            $this->app->error =$e->getMessage();
            $controller = new $class($this->app);
            $controller->$method();                        
         }
    }
}

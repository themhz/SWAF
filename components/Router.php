<?php

namespace SampleWebApp\components;


class Router
{

    public $path;
    public $method;
    public $app;
    protected array $routes = [];

    public function __construct($app)
    {
        $this->app = $app;
        $this->path = $this->app->request->path();
        $this->method = $this->app->request->method();
    }

    public function resolve(bool $canaccess)
    {                        
        try {
            if($canaccess){
                
                $class = '\SampleWebApp\views\privatePages\\' . $this->path . '\Controller';                                             
                $controller = new $class($this->app);            
                $method = $this->method;
                $controller->$method();
            }else{
                $this->app->error ="Cant access this page";                
                $class = '\SampleWebApp\views\publicPages\error\Controller';                             
                $controller = new $class($this->app);            
                $method = $this->method;
                $controller->$method();
            }
            

         } catch (\Throwable $e) {
            echo $e->getMessage();
            $this->app->response->setStatusCode(404);
            $class = '\SampleWebApp\views\publicPages\error\Controller';
            $this->app->error =$e->getMessage();
            $controller = new $class($this->app);
            $controller->$this->method();
         }
    }

    

    
}

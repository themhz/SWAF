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
            if($canaccess && $this->checkIfAdmin()){
                
                $class = '\SampleWebApp\views\adminPages\\' . $this->getAdminPath() . '\Controller';                                             
                $controller = new $class($this->app);            
                $method = $this->method;
                $controller->$method();
            }else{                
                $class = '\SampleWebApp\views\publicPages\\'.$this->path.'\Controller';                             
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

    public function checkIfAdmin(){
        $paths = explode('/', $this->path);
        if($paths[0] == 'admin'){
            return true;
        }else{
            return false;
        }
    }

    public function getAdminPath(){
        $paths = explode('/', $this->path);
        return $paths[1];
    }

    

    
}

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
            if (!$this->checkIfPageIsAdmin()) {
                $class = '\SampleWebApp\views\publicPages\\' . $this->getPath() . '\Controller';
                $this->loadController($class);
            } else if ($canaccess) {
                $class = '\SampleWebApp\views\adminPages\\' . $this->getAdminPath() . '\Controller';
                $this->loadController($class);
            } else {
                $this->app->response->setStatusCode(403);
                $this->app->error = "You can't access this page";
                $this->loadErrorController();
            }
        } catch (\Throwable $e) {
            $this->app->response->setStatusCode(404);
            $this->app->error = $e->getMessage();
            $this->loadErrorController();
        }
    }

    public function loadController($class): void
    {
        $controller = new $class($this->app);
        $method = $this->method;
        $controller->$method();
    }

    public function loadErrorController(): void
    {
        $class = '\SampleWebApp\views\publicPages\error\Controller';
        $controller = new $class($this->app);
        $controller->get();
    }

    public function checkIfPageIsAdmin()
    {
        $paths = explode('/', $this->path);
        if ($paths[0] == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    public function getAdminPath()
    {
        $paths = explode('/', $this->path);
        if (!isset($paths[1]) ||  $paths[1] == "")
            $paths[1] = 'main';

        return $paths[1];
    }

    public function getPath()
    {
        if ($this->path == "")
            $this->path = 'main';

        return $this->path;
    }
}

<?php

namespace SampleWebApp\components;

use SampleWebApp\components\UserAuthenticate;
use SampleWebApp\components\Request;
use SampleWebApp\components\SessionData;

class App
{
    public $config = CONFIG;
    public $rootpath;
    public $error;
    public $request;
    public $response;
    public $router;
    public $user;
    public $userPaths;
    public $session;

    public function __construct($rootpath)
    {
        session_start();
        $this->rootpath = $rootpath;
        $this->response = new Response();
    }

    /**
     * Basic sequence of tasks that will be executed when the application runs
     * 1. Load requested HTTP Method [get,post,etc..] and fields from the request or messagebody
     * 2. Authenticate the user request and get userData
     * 3. Set session for userData
     * 4. Get User paths
     * 5. Set session for userPath
     * 6. Route the user to the corresponding controller
     * 
     * @return void
     */
    public function start()
    {
        // 1. Load requested HTTP Method [get,post,etc..] and fields from the request or messagebody
        $this->loadRequest();

        // 2. Authenticate the user request and get userData
        $this->authenticate();        

        // 3. Set session variables that are user details loaded from the database
        $this->setSessionVariables();       

        // 4. Route the user to the corresponding controller
        $this->route();
    }

    public function loadRequest() : void
    {
        $this->request = new Request();
    }

    public function authenticate() : void
    {
        $auth = new UserAuthenticate($this->request);
        $auth->authenticate();
        $this->user = $auth->result;
    }

    public function setSessionVariables() : void
    {        
        $sessionData = new SessionData();
        $sessionData->set($this->user);

        $this->userPaths = new UserPaths($this->request);
        $this->userPaths->get($sessionData->get());
    }

    public function route() : void
    {
        $router = new Router($this);    
        $router->resolve($this->userPaths->validate($this->request->path(), $this->userPaths->paths));
    }
}

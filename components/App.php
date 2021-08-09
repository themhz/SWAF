<?php

namespace SampleWebApp\components;

use SampleWebApp\components\UserAuthenticate;
use SampleWebApp\components\Request;
use SampleWebApp\components\SessionData;
use SampleWebApp\components\SessionPaths;


class App
{


    public $config = CONFIG;
    public $rootpath;
    public $error;
    public $request;
    public $response;
    public $router;
    public $user;
    public $paths;

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
        $this->request = new Request();

        // 2. Authenticate the user request and get userData
        $this->user = new UserAuthenticate($this->request);        
        $userData = $this->user->authenticate();        
        
        // 3. Set session for userData
        $sessionData = new SessionData();
        $sessionData->set($userData);        

        // 4. Get User paths
        $this->paths = new UserPaths($this->request);        

        // 5. Set session for userPath
        $userPaths = $this->paths->get($sessionData->get()); //pass the user details where user id is contained        
        $sessionPath = new SessionPaths();
        $sessionPath->set($userPaths);
        
        // 6.Route the user to the corresponding controller
        $router = new Router($this);
        $router->resolve($this->paths->validate($this->request->path(), $sessionPath->get()));
        
        $this->end();
    }

    public function end(){

    }
}

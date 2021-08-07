<?php
namespace SampleWebApp\components;
use SampleWebApp\components\User as usercontroller;
use SampleWebApp\components\View;


class App extends http{
   

    protected $config = CONFIG;
    public $rootpath;
    public $error;
    
    public function __construct($rootpath){
        // 1. Load requested HTTP Method [get,post,etc..] and fields from the request or messagebody
        parent::__construct();   
        $this->rootpath = $rootpath;
    }

    public function start(){
        session_start();
        // 2. Authenticate the user request
        // $usercontroller = new usercontroller();
        // $usercontroller->authenticate();

        // 3.check if the user can access the requested end point

        // 4. Route to the requested path
        // 5. Run the controller for the requested path as a requested method
        // 6. Show the result        
        $router = new Router($this);
        $router->resolve();


        
        
    }

}
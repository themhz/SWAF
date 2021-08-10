<?php

/* 
 * Copyright (C) 2021 themhz
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace SampleWebApp\components;

use SampleWebApp\components\UserAuthenticate;
use SampleWebApp\components\Request;
/**
* About
* ----------------------------------------------------------------
* Initialize the web application components
* It is where everything begins. Start reading fromt he start method

*/

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
     * 3. Set session variables that are user details loaded from the database
     * 4. Route the user to the corresponding controller     
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
        $session = new Session();
      
        $session->set($this->user);

        $this->userPaths = new UserPaths($this->request);
        $this->userPaths->get($session->get());
    }

    public function route() : void
    {
        $router = new Router($this);    
        $router->resolve($this->userPaths->validate($this->request->path(), $this->userPaths->paths));
    }
}

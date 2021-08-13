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

namespace swaf\components\handlers;


use swaf\components\handlers\PasswordManager;
use swaf\components\handlers\Paths;
use swaf\models\User;

class Authenticate extends User
{
    public $isAuthenticated = false;
    public $app;

    public function __construct($app)
    {
        parent::__construct();
        $this->app = $app;
    }


    public function authenticate(): void
    {


        if (!$this->hasCertificate()) {

            if ($this->hasUserNameAndPass()) {
                $this->checkUserNameAndPassword();
            }
        } else {

            $this->isAuthenticated = true;
        }
    }

    public function hasCertificate(): bool
    {
        $cert = new Certificate();
        return $cert->isAuthorized();
    }

    public function hasUserNameAndPass(): bool
    {

        $request = $this->app->request->body();
        if (isset($request['email']) && isset($request['password']))
            return true;
        else
            return false;
    }

    public function checkUserNameAndPassword(): void
    {
        $result = $this->select(['email =' => $this->app->request->body()['email']]);
      

        $this->verifyUserNameAndPassword($result);
    }

    public function verifyUserNameAndPassword($result): void
    {
        $passwordManager = new PasswordManager($this->app->request->body()['password']);
        if (isset($result[0]) && $passwordManager->verify($result[0]->password)) {
            $this->isAuthenticated = true;
            $this->setUserDetailsAndCreateCertificate($result);
        } else {
            $this->isAuthenticated = false;
        }
    }

    public function setUserDetailsAndCreateCertificate($result){
        $this->setUserDetails($result[0]);
        $this->createCertificate(session_id());
    }

    public function setUserDetails($details): void
    {
        $session = new Session();
        $session->set('userdetails', $details);
                
        $paths = new Paths($details);       
        $session->set('paths', $paths->get($details));
        //$this->app->userPaths = $paths->get($details);
        // echo "<pre>";
        // print_r($session);
        // echo "<pre>";    
        // die();
        $this->app->userPaths = $paths;
        $this->app->session = $session->getAll();

    }

    public function createCertificate($key): void
    {
        $this->app->certificate = new Certificate($key);
    }

   
}

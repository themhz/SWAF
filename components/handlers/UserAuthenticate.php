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


use swaf\components\handlers\Request;
use swaf\components\handlers\Password;

use swaf\models\UserLogin;
use swaf\models\User as userModel;

class UserAuthenticate extends User
{

    public $result;
    
    public function __construct(Request $data)
    {
        parent::__construct($data);
        $this->result = new UserLogin();
        
    }
    /**
     * Authenticated the user
     *
     * @return array
     */
    public function authenticate(): void
    {        
        $userrbody = $this->request->body();

        if (isset($userrbody['email']) && isset($userrbody['password'])) {
            
            $this->password = new Password($userrbody['password']);
            
            $user = new userModel();
            $this->result = $user->select(['email =' => $userrbody['email']]);
            
            $this->result = isset($this->result[0]) ? $this->result[0] : $this->result;
        }

      
        if (!empty($this->result) && isset($this->result->password) && $this->password->verify($this->result->password)) {
            $this->result->errorcode = 0;
            $this->result->isloggedin = true;
            $this->result->error = "";
            
            
        } else {           
          
            $this->result->errorcode = 1;
            $this->result->isloggedin = false;
            $this->result->error = "user not in database";    
            
           
        }
        
    }
   

    /**
     * Get the value of result
     */ 
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set the value of result
     *
     * @return  self
     */ 
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }
}

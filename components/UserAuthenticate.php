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

use SampleWebApp\models\User as userModel;
use SampleWebApp\components\Request;
use SampleWebApp\components\Password;

class UserAuthenticate extends User
{

    public $result;
    
    public function __construct(Request $data)
    {
        parent::__construct($data);
    }
    /**
     * Authenticated the user
     *
     * @return array
     */
    public function authenticate(): void
    {        
        $userrbody = $this->request->body();
        
        if (isset($userrbody['username']) && isset($userrbody['password'])) {
            
            $this->password = new Password($userrbody['password']);
            
            $user = new userModel();
            $this->result = $user->select(['username =' => $userrbody['username']]);
            
            $this->result = isset($this->result[0]) ? $this->result[0] : $this->result;
        }    

        if (!empty($this->result) && $this->password->verify($this->result->password)) {
            $this->result->errorcode = 0;
            //return (object)$this->result;
        } else {
            //return (object)["error" => "user not in database", "errorcode" => 1];
            $this->result = (object)["error" => "user not in database", "errorcode" => 1];
        }
    }
   
}

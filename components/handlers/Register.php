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

use swaf\models\User as UserModel;
use swaf\components\Handlers\Request;

class Register
{

    public $result;

    public function __construct()
    {        
    }
    /**
     * Register the user
     *
     * @return array
     */
    public function register()
    {
        $user = new UserModel();
        $userrbody = $this->request->body();

        if (isset($userrbody['username']) && isset($userrbody['password'])) {

            $user->firstname = "tasos";
            $user->lastname = "vagelis";
        }


        $user->insert();
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

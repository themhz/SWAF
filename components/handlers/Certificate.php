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
use swaf\models\User;
use swaf\components\handlers\Session;


class Certificate {
    public $certificate="";
    
    public function __construct($key = ""){        
        if(!$key=="")
            $this->create($key);
    }

    public function isAuthorized(){
        if(empty($this->key)){
            return false;
        }else{
            return true;
        }
    }

    public function create($key){

        $session = new Session();
        $session->set('certificate', $key);
        $this->certificate = $session->get('certificate');
        return $this;
    }

    /**
     * Get the value of key
     */ 
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set the value of key
     *
     * @return  self
     */ 
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }
}
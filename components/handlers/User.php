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

class User
{
    public $request;
    public $paths;

    public function __construct(Request $request)
    {        
        $this->request = $request;
    }

    
    


    /**
     * Get the value of request
     */ 
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set the value of request
     *
     * @return  self
     */ 
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Get the value of paths
     */ 
    public function getPaths()
    {
        return $this->paths;
    }

    /**
     * Set the value of paths
     *
     * @return  self
     */ 
    public function setPaths($paths)
    {
        $this->paths = $paths;

        return $this;
    }
}

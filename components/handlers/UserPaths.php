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

use swaf\models\User as userModel;
use swaf\models\User_paths;
use swaf\components\handlers\Request;

class UserPaths extends User
{

    public $paths;

    public function __construct(Request $data)
    {
        parent::__construct($data);
    }
    /**
     * Get user Paths
     *
     * @return object
     */
    public function get($user): void
    {
        $result = null;
        $user_paths = new User_paths();

        // if the user is authenticated get his paths
        if ($user->errorcode == 0) {
            $result = $user_paths->select(['user_id =' => $user->id]);
            $result = isset($result[0]) ? $result : null;
            $paths = [];

            if (!empty($result)) {
                foreach ($result as $value) {
                    $paths[] = $value->path;
                }
            }
        }

        if (empty($paths)) {
            $this->paths = (object)["error" => "user doesnt have any path rights", "errorcode" => 2];
        } else {
            $this->paths = (object) $paths;
        }
    }

    public function validate($path, $paths): bool
    {

        $p = explode('/', $path);

        if ($p[0] == "admin") {
            if (!isset($p[1]) ||  $p[1] == "")
                $p[1] = 'main';

            return in_array($p[1], (array)$paths);
        } else {
            return in_array($p[0], (array)$paths);
        }
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

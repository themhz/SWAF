<?php

namespace SampleWebApp\components;

use SampleWebApp\models\User as userModel;
use SampleWebApp\models\User_paths;
use SampleWebApp\components\Request;

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

        // if the user is authenticated then do this
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
}

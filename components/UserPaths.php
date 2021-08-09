<?php

namespace SampleWebApp\components;

use SampleWebApp\models\User as userModel;
use SampleWebApp\models\User_paths;
use SampleWebApp\components\Request;

class UserPaths extends User
{

    public $result;

    public function __construct(Request $data)
    {
        parent::__construct($data);
    }
    /**
     * Get user Paths
     *
     * @return object
     */
    public function get($user): object
    {
        $result = null;

        $user_paths = new User_paths();

        $result = $user_paths->select(['user_id =' => $user->id]);
        $result = isset($result[0]) ? $result : null;
        $paths = [];

        if (!empty($result)) {
            foreach ($result as $value) {
                $paths[] = $value->path;
            }
        }


        if (!empty($paths)) {
            return (object)$paths;
        } else {
            return (object)["error" => "user doesnt have any path rights", "errorcode" => 2];
        }
    }

    public function validate($path, $paths): bool
    {

        return in_array($path, (array)$paths);
    }
}

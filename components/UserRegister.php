<?php

namespace SampleWebApp\components;

use SampleWebApp\models\User as userModel;
use SampleWebApp\components\Request;

class UserRegister extends User
{

    public $result;

    public function __construct(Request $data)
    {
        parent::__construct($data);
    }
    /**
     * Register the user
     *
     * @return array
     */
    public function register()
    {
        $user = new userModel();
        $userrbody = $this->request->body();

        if (isset($userrbody['username']) && isset($userrbody['password'])) {

            $user->firstname = "tasos";
            $user->lastname = "vagelis";
        }


        $user->insert();
    }
}

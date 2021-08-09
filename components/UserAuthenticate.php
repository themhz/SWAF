<?php

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
    public function authenticate(): object
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
            return (object)$this->result;
        } else {
            return (object)["error" => "user not in database", "errorcode" => 1];
        }
    }
}

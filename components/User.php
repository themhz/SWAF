<?php

namespace SampleWebApp\components;

use SampleWebApp\models\User as userModel;
use SampleWebApp\models\User_paths;
use SampleWebApp\components\Request;

class User
{
    public $request;
    public $paths;

    public function __construct(Request $request)
    {
        $_SESSION['USER'] = ['DETAILS' => "", 'PATHS' => ""];
        $this->request = $request;
    }

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

    // /**
    //  * Authenticated the user
    //  *
    //  * @return array
    //  */
    // public function authenticate()
    // {
    //     $userrbody = $this->request->body();
    //     $result = null;

    //     if (isset($userrbody['username']) && isset($userrbody['password'])) {
    //         $user = new userModel();
    //         $result = $user->select(['username =' => $userrbody['username'], ' and password =' => $userrbody['password']]);
    //         $result = isset($result[0]) ? $result[0] : null;
    //     }

    //     if (!empty($result)) {
    //         $this->setUserSession($result);                        
    //         $this->setUserPaths();            
         
    //         return $this->getUserSession();
    //     } else {
    //         return $this->setUserSession(["error" => "user not in database", "errorcode" => 1]);
    //     }
    // }

    public function getUserAccessRights()
    {
        $result = null;

        $user_paths = new User_paths();       
         
        $result = $user_paths->select(['user_id =' => $this->getUserSessionDetails()->id]);        
        $result = isset($result[0]) ? $result : null;
        $paths = [];

        
        foreach ($result as $value) {
            $paths[] = $value->path;
        }
        
        
        if (!empty($paths)) {
            return $paths;
        } else {
            return $this->setUserSession(["error" => "user doesnt have any path rights", "errorcode" => 2]);
        }
    }

    /**
     * Gets an array of data that is posted usually from the body and loads them to the session user object
     *
     * @param [array] $data 
     * @return string json
     */
    public function setUserSession($data)
    {
        $user = new userModel();      
        $user->loadData($data);
        $_SESSION['USER']['DETAILS'] = json_encode($user);                    
    }

    public function setUserPaths()
    {                       
        $_SESSION['USER']['PATHS'] = json_encode((object)$this->getUserAccessRights());        
    }

    

    /**
     * returns the user session in the original format Std Object
     *
     * @return object
     */
    public function getUserSession()
    {
        return $_SESSION['USER'];
    }
    public function getUserSessionDetails()
    {
        return json_decode($this->getUserSession()['DETAILS']);
    }

    public function getUserSessionPaths(){
        return json_decode($this->getUserSession()['PATHS']);
    }

    /**
     * isLogedIn function
     * checked if the user is logged in the system by user the getUserSession. it converts it to array and checks if its empty or not. If its empty then user is not isLogedIn else he is
     * 
     * @return boolean
     */
    public function isLogedIn()
    {
        if (empty((array) $this->getUserSession())) {
            return false;
        } else {
            return true;
        }
    }

    public function checkUserPathRight(){        
        return in_array($this->request->path(), (array)$this->getUserSessionPaths());
    }
}

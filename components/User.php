<?php

namespace SampleWebApp\components;
use SampleWebApp\models\User as userModel;
use SampleWebApp\components\Http;

class User
{

    public function __construct()
    {
    }

    public function register()
    {
        $user = new userModel();        
        $user->firstname = "tasos";
        $user->lastname = "vagelis";
        
        $user->insert();
    }

    public function authenticate()
    {
         $http = new Http();
         $userrbody = $http->body();
         $result = null;

         if(isset($userrbody['username']) && isset($userrbody['password'])) {
            $user = new userModel();
            $result = $user->select(['username ='=>$userrbody['username'] ,' and password ='=> $userrbody['password']]);
            $result = isset($result[0]) ? $result[0] : null;
         }                     
         
         if($result!= null && $result->username == "themhz" && $result->password == "526996"){
             echo "success";
         }else{
             echo "error";
         }
        
    }

    public function update(){
        $user = new userModel();
        $user->firstname = "eythimios";
        $user->id = 1;
        print_r($user->update());
    }

    
}

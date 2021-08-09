<?php

namespace SampleWebApp\models;
use SampleWebApp\components\Model;
use \DateTime;

class User extends Model
{
    public int $id;
    public string $firstname;
    public string $lastname;
    public string $phone;
    public string $mobile;
    public string $email;
    public string $username;
    public string $password;
    public DateTime $regdate;

    public function __construct()
    {
        parent::__construct('users');
    }

    

    
}

<?php

namespace SampleWebApp\components;

class Password
{
    public string $password;
    public function __construct(string $password){
        $this->password = $password;
    }

    public function hash(){
        return password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function verify($hashed_password){
        return password_verify($this->password, $hashed_password);
    }

    public function __toString() {

        return $this->password;
    }

}
<?php

namespace SampleWebApp\components;

use SampleWebApp\models\User as userModel;
use SampleWebApp\components\Request;

abstract class Session
{
    public $session;
    public function __construct()
    {
        $_SESSION['USER'] = array();
        $this->session = $_SESSION['USER'];
    }

    abstract public function set(object $data);
    abstract public function get(): object;

    
}

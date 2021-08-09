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

    
    

}

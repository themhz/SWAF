<?php

namespace SampleWebApp\models;
use SampleWebApp\components\Model;
use \DateTime;

class User_paths extends Model
{
    public int $id;
    public int $user_id;
    public string $path;    
    public DateTime $regdate;

    public function __construct()
    {
        parent::__construct('user_paths');
    }

    
}
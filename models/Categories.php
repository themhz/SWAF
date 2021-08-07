<?php

namespace SampleWebApp\models;
use SampleWebApp\components\Model;
use \DateTime;

class Categories extends Model
{
    public int $id;
    public int $parent_id;
    public string $name;    
    public DateTime $regdate;

    public function __construct()
    {
        parent::__construct('categories');
    }

    
}
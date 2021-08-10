<?php

namespace SampleWebApp\models;
use SampleWebApp\components\Model;
use \DateTime;

class Products extends Model
{
    public int $id;
    public string $name;
    public string $price;    
    public DateTime $regdate;

    public function __construct()
    {
        parent::__construct('products');
    }

    

    
}

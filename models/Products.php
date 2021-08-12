<?php

namespace swaf\models;
use swaf\components\core\Model;
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

    

    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of regdate
     */ 
    public function getRegdate()
    {
        return $this->regdate;
    }

    /**
     * Set the value of regdate
     *
     * @return  self
     */ 
    public function setRegdate($regdate)
    {
        $this->regdate = $regdate;

        return $this;
    }
}

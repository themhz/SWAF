<?php

namespace SampleWebApp\components;

class Controller
{
    protected $app;
    public function __construct($app){
        $this->app = $app;
    }
}

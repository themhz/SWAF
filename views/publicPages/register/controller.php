<?php
namespace SampleWebApp\views\publicPages\register;
use SampleWebApp\components\Controller as baseController;

class Controller extends baseController{
    public function __construct() {}

    public function post(){
        echo "login post";
    }

    public function get(){
        echo "get";
    }

    public function put(){
        echo "put";
    }

    public function delete(){
        echo "delete";
    }
}
<?php

namespace SampleWebApp\components;

class SessionPaths extends Session
{    
    public function __construct()
    {
        parent::__construct();
    }

    public function set(object $data)
    {
        $this->session['PATHS'] = json_encode($data);
    }
    public function get(): object
    {
        return json_decode($this->session['PATHS']);
    }
}

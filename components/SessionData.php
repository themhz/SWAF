<?php

namespace SampleWebApp\components;

class SessionData extends Session
{    
    public function __construct()
    {
        parent::__construct();
    }

    public function set(object $data)
    {
        $this->session['DATA'] = json_encode($data);
    }
    public function get(): object
    {
        return json_decode($this->session['DATA']);
    }
}

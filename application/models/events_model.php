<?php

class Events_model extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->page_limit = 50;
    }

    public function create($eventsObject)
    {
        
    }
}
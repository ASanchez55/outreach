<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends MY_Controller 
{    
	public function __construct()
    {
	    parent::__construct();
	    // Your own constructor code
        $this->load->model('admins_model');

	    $this->load->library('form_validation');
        $this->load->library('set_custom_session');
        $this->load->library('set_views');
    }

    public function create()
    {
        
    }
}

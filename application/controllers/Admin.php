<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{

	public function __construct()
    {
	    parent::__construct();
	    // Your own constructor code
	    $this->load->model('Model_insert');
	    $this->load->library('form_validation');
    }

    public function index()
    {
    	
    }

}
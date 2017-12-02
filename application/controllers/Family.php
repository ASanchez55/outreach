<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Family extends MY_Controller 
{    
	public function __construct()
    {
        parent::__construct();
	    // Your own constructor code
        $this->load->model('Model_insert');
        $this->load->model('Model_return');

	    $this->load->model('FamilyModel');
	    $this->load->library('form_validation');
	    $this->load->library('viewbag');
	    
	    //check if user is logged on
	    $this->load->library('set_custom_session');
	    $this->admin_data = $this->set_custom_session->admin_session();
    }

    public function index()
    {
        if ( $this->input->get('search_value') ) 
        {
            $name = $this->input->get('search_value');
        	$this->data['output'] = $this->FamilyModel->findFamilyByName($name);
        	$this->render('family/index');
        }
        else
        {
        	$this->data = array_merge($this->data, array(
        		'output' => '' 
        	));
        	$this->render('family/index');
        }
    }

    public function create()
    {
        $this->data['family_name'] = '';
        $this->data['comp_add'] = '';
        $this->render('family/create');
    }

    public function saveFamily()
    {
        // Save only on POST
        if ($this->input->method() === 'post')
        {
            $family_name = $this->input->post('family_name');
            $comp_add = $this->input->post('comp_add');

            $this->FamilyModel->createFamily($family_name, $comp_add);
        }
        else 
        {
            redirect('family/create');
        }
    }

    public function register()
    {
        $this->data['family_name'] = '';
        $this->data['comp_add'] = '';
        $this->data['date_registered'] = '';
        $this->data['event_list'] = $this->Model_return->event_list();

        $this->render($this->viewbag->family_create());
    }
}
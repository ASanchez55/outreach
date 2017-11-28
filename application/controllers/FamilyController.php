<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FamilyController extends MY_Controller 
{    
	public function __construct()
    {
        parent::__construct();
	    // Your own constructor code
	    $this->load->model('Model_insert');
	    $this->load->model('Model_return');
	    $this->load->library('form_validation');
	    $this->load->library('viewbag');
	    
	    //check if user is logged on
	    $this->load->library('set_custom_session');
	    $this->admin_data = $this->set_custom_session->admin_session();
    }

    public function create()
    {
        $this->data['family_name'] = '';
        $this->data['comp_add'] = '';
        $this->data['date_registered'] = '';
        $this->data['event_list'] = $this->Model_return->event_list();

        $this->render($this->viewbag->family_create());
    }

    public function search()
    {
        if ( $this->input->get('search_value') ) 
        {
        	$data = array_merge($this->data, array(
        		'search_value'	=> $this->input->get('search_value'),
        		'table'			=> 'family AS F',
        		'type'			=> 'family' 
        	));

        	$this->data['output'] = $this->Model_return->search($data);
        	$this->render($this->viewbag->family_search());
        }
        else
        {

        	$this->data = array_merge($this->data, array(
        		'output' => '' 
        	));

        	$this->render($this->viewbag->family_search());
        }
    }
}
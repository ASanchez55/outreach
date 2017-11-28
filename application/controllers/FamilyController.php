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
        
        $this->load->model('Family');

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

    public function addFamilyMember($familyId)
    {
        $familyName = $this->Family->getFamilyName($familyId);

        if ($familyName)
        {
            $this->session->set_userdata('family' , $familyName);

			$options = array(
                'Male'		=> 'Male',
                'Female'	=> 'Female'
            );
            $js = 'class="form-control"';
            $this->data['gender'] =  form_dropdown('gender', $options, '',$js);

            //radio button for head of family
            $options = array(
                    'name'          => 'head_family',
                    'value'         => 1,
                    'checked'       => FALSE
            );

            $this->data['head_family1'] = form_radio($options);

            $options = array(
                    'name'          => 'head_family',
                    'value'         => 0,
                    'checked'       => TRUE
            );

            $this->data['head_family2'] = form_radio($options);

            $this->data['fname'] = '';
            $this->data['birth_date'] = '';
            $this->data['family_name'] = $familyName;

            $this->render($this->viewbag->family_addFamilyMember());
        }
        else
        {
            redirect('/family/search');
        }
    }
}
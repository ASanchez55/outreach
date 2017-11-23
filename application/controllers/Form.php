<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller 
{

	public function __construct()
    {
	    parent::__construct();
	    // Your own constructor code
	    $this->load->model('Model_insert');
	    $this->load->library('form_validation');
	    $this->load->library('set_views');

	    //check if user is logged on
	    $this->load->library('set_custom_session');

	    if ( $this->session->has_userdata('logged_in' ) )
		{
	    	$this->admin_data = $this->set_custom_session->admin_session();
	    }
    }

    public function index()
    {
    	$config = array(
                    array(
                            'field' => 'family_name',
                            'label' => 'Family Name',
                            'rules' => 'trim|required|xss_clean'
                    )
            ); 
		$this->form_validation->set_rules($config);

		if ( $this->form_validation->run() == TRUE )
		{

			$array_insert = array(
				'name' => $this->input->post('family_name') 
			);

			//first var = array to insert in the table, var 2 = table name
			$family_id = $this->Model_insert->insert_info( $array_insert, 'family' );

			$this->session->set_userdata('family' ,$family_id);

			redirect('/Form/participant_form');
		}
		else
		{
			if ( $this->session->has_userdata('family') ) 
			{
				# code...
				redirect('/Form/participant_form');
			}//end session checker
			else
			{
				$this->load->view($this->set_views->form_family());
			}


		}

    }//end index

    public function participant_form()
    {
    	$config = array(
                    array(
                            'field' => 'fname',
                            'label' => 'First Name',
                            'rules' => 'trim|required|xss_clean'
                    ),
                     array(
                            'field' => 'gender',
                            'label' => 'Gender',
                            'rules' => 'trim|required|xss_clean'
                    ),
                      array(
                            'field' => 'birth_date',
                            'label' => 'Birth Date',
                            'rules' => 'trim|required|xss_clean'
                    ),
                       array(
                            'field' => 'province',
                            'label' => 'Province',
                            'rules' => 'trim|required|xss_clean'
                    ),
                        array(
                            'field' => 'citymun',
                            'label' => 'City/Municipality',
                            'rules' => 'trim|required|xss_clean'
                    ),
                         array(
                            'field' => 'brgy',
                            'label' => 'Barangay',
                            'rules' => 'trim|required|xss_clean'
                    ),
                         array(
                            'field' => 'comp_add',
                            'label' => 'Complete Address(House Number, Building, and Street Name)',
                            'rules' => 'required|xss_clean'
                    )
            ); 
		$this->form_validation->set_rules($config);

		if ( $this->form_validation->run() == TRUE )
		{
			$family_id = $this->session->userdata('family');

			$array_insert = array(
				'fname'				=> $this->input->post('fname'),
				'family_name_id'	=> $family_id,
				'gender'			=> $this->input->post('gender'),
				'birth_date'		=> $this->input->post('birth_date'),
				'refprovince_id'	=> $this->input->post('province'),
				'refcitymun_id'		=> $this->input->post('citymun'),
				'refbrgy_id'		=> $this->input->post('brgy'),
				'comp_address'		=> $this->input->post('comp_add'),
				'date_registered'	=> 'DATE(NOW())'

			);

			//first var = array to insert in the table, var 2 = table name
			$family_id = $this->Model_insert->insert_info( $array_insert, 'participants' );


		}
		else
		{
			if ( $this->session->has_userdata('family') ) 
			{
				# code...
				$this->load->view($this->set_views->form_participant());
				
			}//end session checker
			else
			{
				redirect('/Form');
			}
		}


    }

}
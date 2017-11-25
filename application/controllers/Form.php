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
	    $this->load->model('Model_others');

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
                    ),
                    array(
                            'field' => 'Address_Province',
                            'label' => 'Province',
                            'rules' => 'trim|required|xss_clean'
                    ),
                        array(
                            'field' => 'Address_City',
                            'label' => 'City/Municipality',
                            'rules' => 'trim|required|xss_clean'
                    ),
                         array(
                            'field' => 'Address_Barangay',
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

			$array_insert = array(
				'name' 			=> $this->input->post('family_name'),
				'provCode'		=> $this->input->post('Address_Province'),
				'citymunCode'	=> $this->input->post('Address_City'),
				'brgyCode'		=> $this->input->post('Address_Barangay'),
				'comp_address'	=> $this->input->post('comp_add'), 
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
				//header
				$this->load->view($this->set_views->admin_header());
				//to escape error in form validation set_value
				$data['family_name'] = '';
				$data['comp_add'] = '';

				$data['province_list'] = $this->Model_others->address_province('');
				$this->load->view($this->set_views->form_family(), $data);
				//footer
				$this->load->view($this->set_views->admin_footer());

				$this->load->view($this->set_views->ajax());
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
                            'field' => 'date_registered',
                            'label' => 'Date Registered',
                            'rules' => 'trim|required|xss_clean'
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
				'date_registered'	=> $this->input->post('date_registered')

			);

			//first var = array to insert in the table, var 2 = table name
			$this->Model_insert->insert_info( $array_insert, 'participants' );

			//set session for form success
			$array_message = array(
				'msg'			=> 'Add family member success',
				'msg2'			=> 'Add another family member',
				're_link'		=> '/Form/participant_form',
				'msg3' 			=> 'Create new Family',
				're_link2'		=> '/Form/unset_family'
			);
			$this->session->set_userdata('success_message' ,$array_message);

			redirect('/Form/form_success');


		}
		else
		{
			//unset session from success_message
			if ($this->session->has_userdata('success_message')) 
			{
				# code...
				$this->session->unset_userdata('success_message');

			}

			if ( $this->session->has_userdata('family') ) 
			{
				# code...

				//form dropdown for gender
				$options = array(
					'Male'		=> 'Male',
					'Female'	=> 'Female'
				);
				$js = 'class="form-control"';
				$data['gender'] =  form_dropdown('gender', $options, '',$js);

				//to escape error in form validation set_value
				$data['fname'] = '';
				$data['birth_date'] = '';
				$data['date_registered'] = '';
				//header
				$this->load->view($this->set_views->admin_header());

				$this->load->view($this->set_views->form_participant(), $data);

				//footer
				$this->load->view($this->set_views->admin_footer());
				
			}//end session checker
			else
			{
				redirect('/Form');
			}
		}


    }//enf function participant

    // prevents form resubmission on refresh
    public function form_success()
    {
    	if ($this->session->has_userdata('success_message')) 
    	{
    		# code...
    		$this->load->view($this->set_views->admin_header());
    		$data = array(
    			'msg'		=> $this->session->userdata('success_message')['msg'],
    			'msg2'		=> $this->session->userdata('success_message')['msg2'],
    			're_link'	=> $this->session->userdata('success_message')['re_link'],
    			'msg3'		=> $this->session->userdata('success_message')['msg3'],
    			're_link2'	=> $this->session->userdata('success_message')['re_link2']  
    		);
    		$this->load->view($this->set_views->form_success(), $data);

    		//footer
			$this->load->view($this->set_views->admin_footer());
    	}
    	else
    	{
    		redirect('/Form');
    	}
    }

    public function unset_family()
    {
    	$this->session->unset_userdata('family');
    	redirect('/Form');
    }

}//end class
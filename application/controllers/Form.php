<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends MY_Controller 
{
	private $admin_data;

	public function __construct()
    {
	    parent::__construct();
	    // Your own constructor code
	    $this->load->model('Model_insert');
	    $this->load->model('Model_return');
	    $this->load->library('form_validation');
	    $this->load->library('set_views');
	    //$this->load->model('Model_others');

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
                    'field' => 'comp_add',
                    'label' => 'Address',
                    'rules' => 'required|xss_clean'
                ),
                 array(
                    'field' => 'date_registered',
                    'label' => 'Date Registered',
                    'rules' => 'required|xss_clean'
                )
        ); 
		$this->form_validation->set_rules($config);

		if ( $this->form_validation->run() == TRUE )
		{

			$array_insert = array(
				'name' 			=> $this->input->post('family_name'),
				'comp_address'	=> $this->input->post('comp_add'), 
			);

			//first var = array to insert in the table, var 2 = table name
			$family_id = $this->Model_insert->insert_info( $array_insert, 'family' );

			$this->session->set_userdata('family' ,$family_id);

			$array_insert = array(
				'event_id' 			=> $this->input->post('event'),
				'date_registered'	=> $this->input->post('date_registered'),
				'family_id'			=> $family_id 
			);

			//first var = array to insert in the table, var 2 = table name
			$this->Model_insert->insert_info( $array_insert, 'event_attendance' );

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
				$this->data['family_name'] = '';
				$this->data['comp_add'] = '';
				$this->data['date_registered'] = '';
				$this->data['event_list'] = $this->Model_return->event_list();


				//$this->load->view($this->set_views->ajax());

				$this->render($this->set_views->form_family());

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
                    'field' => 'head_family',
                    'label' => 'Head of Family',
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
				'head_family'		=> $this->input->post('head_family')

			);

			//first var = array to insert in the table, var 2 = table name
			$this->Model_insert->insert_info( $array_insert, 'participants' );

			//set session for form success
			$array_message = array(
				'msg'		=> 'Add family member success',
				'msg2'		=> 'Add another family member',
				're_link'	=> '/Form/participant_form',
				'msg3' 		=> 'Create new Family',
				're_link2'	=> '/Form/unset_family',
				'type'		=> 'participants',
				'id'		=> $family_id	
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

				//to escape error in form validation set_value
				$this->data['fname'] = '';
				$this->data['birth_date'] = '';
				

				//show family name
				$this->data['family_name'] = $this->Model_return->return_family($this->session->userdata('family'));

				$this->render($this->set_views->form_participant());
				
			}//end session checker
			else
			{
				redirect('/search_family');
			}
		}


    }//enf function participant

    // prevents form resubmission on refresh
    public function form_success()
    {
    	if ($this->session->has_userdata('success_message')) 
    	{
    		# code...
    		$this->data = array_merge($this->data, array(
    			'msg'		=> $this->session->userdata('success_message')['msg'],
    			'msg2'		=> $this->session->userdata('success_message')['msg2'],
    			're_link'	=> $this->session->userdata('success_message')['re_link'],
    			'msg3'		=> $this->session->userdata('success_message')['msg3'],
    			're_link2'	=> $this->session->userdata('success_message')['re_link2']  
			));

    		if ($this->session->userdata('success_message')['type'] == 'participants') 
    		{
    			# code...
    			$this->data['output'] = $this->Model_return->return_participants($this->session->userdata('success_message')['id']);
    		}
    		elseif ($this->session->userdata('success_message')['type'] == 'event') 
    		{
    			# code...
    			$this->data['output'] = $this->Model_return->return_event($this->session->userdata('success_message')['id']);
    		}
    		$this->render($this->set_views->form_success());
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

    public function search_family()
    {
    	
    	if ( $this->input->get('search_value') ) 
        {
        	$data = array_merge($this->data, array(
        		'search_value'	=> $this->input->get('search_value'),
        		'table'			=> 'family AS F',
        		'type'			=> 'family' 
        	));

        	$this->data['output'] = $this->Model_return->search($data);

        	//$this->load->view($this->set_views->search_family(), $data);
        	$this->render($this->set_views->search_family());
        }
        else
        {

        	$this->data = array_merge($this->data, array(
        		'output' => '' 
        	));
        	//$this->load->view($this->set_views->search_family(), $data);
        	$this->render($this->set_views->search_family());
        }

        //footer
		//$this->load->view($this->set_views->admin_footer());
    }

    public function add_family_member($data = '')
    {
    	if ($data) 
    	{
    		# code...
    		$checker = $this->Model_return->return_family($data);

    		if ($checker != FALSE) 
    		{
    			# code...
    			$this->session->set_userdata('family' ,$data);
    			redirect('/Form');
    		}
    		else
    		{
    			redirect('/search_family');
    		}
    	}
    	else
    	{
    		redirect('/Form');
    	}
    }

    public function form_event()
    {
    	$config = array(
                array(
                    'field' => 'event_name',
                    'label' => 'Event Name',
                    'rules' => 'trim|required|xss_clean'
                ),
                array(
                    'field' => 'date',
                    'label' => 'Event Date',
                    'rules' => 'required|xss_clean'
                )
        ); 
		$this->form_validation->set_rules($config);

		if ( $this->form_validation->run() == TRUE )
		{

			$array_insert = array(
				'name' 	=> $this->input->post('event_name'),
				'date'	=> $this->input->post('date'), 
			);

			//first var = array to insert in the table, var 2 = table name
			$event_id = $this->Model_insert->insert_info( $array_insert, 'event' );

			$array_message = array(
				'msg'		=> 'Add Event success',
				'msg2'		=> 'Add another Event',
				're_link'	=> '/Form/form_event',
				'msg3' 		=> 'Home',
				're_link2'	=> '/Form',
				'type'		=> 'event',
				'id'		=> $event_id	
			);
			$this->session->set_userdata('success_message' ,$array_message);

			redirect('/Form/form_success');
		}
		else
		{
			
			$this->data['event_name'] = '';
			$this->data['date'] = '';

			$this->render($this->set_views->form_event());

			

		}
    }

}//end class
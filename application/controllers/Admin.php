<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller 
{    
	public function __construct()
    {
	    parent::__construct();
	    // Your own constructor code
        $this->load->model('Model_user_verification');
	    $this->load->model('Model_insert');
	    $this->load->library('form_validation');
        $this->load->library('set_custom_session');
        $this->load->library('set_views');

        // Set view properties
        $this->data['error_message'] = '';

        if ( $this->session->has_userdata('logged_in' ) )
        {
            $this->admin_data = $this->set_custom_session->admin_session();
        }
    }

    public function index()
    {

        $config = array(
                    array(
                            'field' => 'username',
                            'label' => 'Username',
                            'rules' => 'trim|required|xss_clean'
                    ),
                     array(
                            'field' => 'password',
                            'label' => 'Password',
                            'rules' => 'trim|required|xss_clean'
                    )     
            );

        $this->form_validation->set_rules($config);

        if ( $this->form_validation->run() == FALSE ) 
        {
            # code...
            if ($this->session->has_userdata('logged_in'))
            {
                # code...
            
                //$this->load->view('view_admin_layo', $this->admin_data);
                //$this->admin_layo();
                //$this->load->view('admin/dashboard');

                //$this->admin_footer();
                //$this->load->view('view_admin_footer');
                $this->middle = "user_login";
                $this->render("user_login");
            }//end session user logged_in true
            else
            {
                $this->render('user_login');
            }
        }//form validation checker
        else
        {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password')
            );

            $result = $this->Model_user_verification->user_login($data);

            //successful login
            if ( $result == TRUE ) 
            {
                # code...
                /*
                $this->employee_no = $this->session->userdata('logged_in')['employee_no'];
                $this->admin_fname = $this->session->userdata('logged_in')['first_name'];
                $this->admin_lname = $this->session->userdata('logged_in')['last_name'];
                $this->admin_data = array( 
                    'employee_no' => $this->employee_no,
                    'admin_fname' => $this->admin_fname,
                    'admin_lname' => $this->admin_lname,
                );
                */
                //test
                //$this->admin_data = $this->set_custom_session->admin_session();
                
                //$this->load->view('admin/dashboard');
                $this->render($this->set_views->admin_home());
                //redirect('/Form');
            }// user true
            else
            {
                $this->data['error_message'] = 'Invalid Username or Password';
                $this->render($this->set_views->login());
            }
        }//end form validation false


        
    }

    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('family');
        redirect('/admin');
    }

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
    private $admin_header;
    private $admin_footer;
    private $admin_data;

	public function __construct()
    {
	    parent::__construct();
	    // Your own constructor code
        $this->load->model('Model_user_verification');
	    $this->load->model('Model_insert');
	    $this->load->library('form_validation');
        $this->load->library('set_views');

        $this->admin_header = $this->set_views->admin_header();
        $this->admin_footer = $this->set_views->admin_footer();

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
            if ($this->session->has_userdata('logged_in')  )
            {
                # code...
            
                //$this->load->view('view_admin_header', $this->admin_data);
                //$this->admin_header();
                //$this->load->view('admin/dashboard');
                //$this->admin_footer();
                //$this->load->view('view_admin_footer');

                redirect('/Form');


            }//end session user logged_in true
            else
            {
                $data = array('error_msg' => '');
                $this->admin_header();
                $this->load->view($this->set_views->login(), $data);
                $this->admin_footer();
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
                
                $this->admin_header();
                //$this->load->view('admin/dashboard');
                $this->admin_footer();

                redirect('/Form');

            }// user true
            else
            {
                $data = array('error_msg' => 'Invalid Username or Password');
                
                $this->load->view($this->set_views->login(), $data);
                
            }
        }//end form validation false


        
    }

    private function admin_header()
    {
        
        $this->load->view( $this->admin_header, $this->admin_data);
    }

    private function admin_footer()
    {
        $this->load->view($this->admin_footer);
    }

    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('family');
        redirect('/admin');
    }

}
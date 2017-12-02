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
            if ($this->session->has_userdata('logged_in'))
            {
                $this->render($this->set_views->admin_home());
            }
            else
            {
                $this->render($this->set_views->login());
            }
        }
        else
        {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password')
            );

            $result = $this->Model_user_verification->user_login($data);

            if ( $result == TRUE ) 
            {
                $this->render($this->set_views->admin_home());
            }
            else
            {
                $this->data['error_message'] = 'Invalid Username or Password';
                $this->render($this->set_views->login());
            }
        } 
    }

    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('family');
        redirect('/admin');
    }

}
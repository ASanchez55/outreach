<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Set_custom_session 
{

	protected $CI;

	public function __construct()
    {
        // Do something with $params
        $this->CI =& get_instance();
        $this->CI->load->library('session');
        $this->CI->load->helper('url');

    }

	public function admin_session()
	{
		
		if ( $this->CI->session->has_userdata('logged_in' ) )
		{
			# code...
			

			$data = array( 
				'username' => $this->CI->session->userdata('logged_in')['username'],
				'admin_fname' => $this->CI->session->userdata('logged_in')['fname'],
				'admin_lname' => $this->CI->session->userdata('logged_in')['lname']
			);

			return $data;
		}
		else
		{
			redirect('/admin');
		}
	}

	
}
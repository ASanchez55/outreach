<?php
class Model_user_verification extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                // Your own constructor code
        }

        public function user_login( $data )
        {
        	$this->db->select('id, fname, lname');
			$this->db->from('admin');
			$this->db->where('username', $data['username']);
			$this->db->where('password', $data['password']);
			$this->db->where('valid', 1);
			$query = $this->db->get();

			if ($query->num_rows() == 1) 
			{
				//reset query builder
				$this->db->reset_query();
				foreach ($query->result() as $row)
				{
					//session set session
					$data = array(
						'id'	=> $row->id,
						'lname'	=> $row->lname,
						'fname'	=> $row->fname
					);

					$this->session->set_userdata('logged_in' ,$data);
					return true;
				}
			} 
			else 
			{
				return false;
			}

        }//end user_login

}
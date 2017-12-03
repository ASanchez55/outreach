<?php

class Users_model extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->page_limit = 50;
    }

    public function getUser( $username, $password )
    {
        $this->db->select('id, first_name AS first_name, last_name AS last_name');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->where('valid', 1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) 
        {
            //reset query builder
            $this->db->reset_query();
            foreach ($query->result_array() as $row)
            {
                return $row;
            }
        } 
    }
}
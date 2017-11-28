<?php

class Family extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getFamilyName($id)
    {
        $this->db->select('name');
    	$this->db->from('family');
    	$this->db->where('id', $id);

    	$query = $this->db->get();

        if ($query->num_rows() == 1 ) 
        {
        	//reset query builder
            $this->db->reset_query();

            foreach ( $query->result() as $row )
            {
            	$output = $row->name;
            }
            return $output;
        }
        else
        {
        	return FALSE;
        }
    }
}
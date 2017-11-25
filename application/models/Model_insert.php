<?php
class Model_insert extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                // Your own constructor code
        }

        public function insert_info( $array_insert, $table_name )
		{
			$this->db->insert($table_name, $array_insert); 
			// get the id of latest insert
			$primary_no = $this->db->insert_id();

			//reset query builder
	        $this->db->reset_query();

			return $primary_no;
		}

		public function return_family($data)
		{
			$this->db->select('name');
        	$this->db->from('family');
        	$this->db->where('id', $data);

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
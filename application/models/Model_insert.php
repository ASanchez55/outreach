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
			return $primary_no;
		}
}
<?php

class Events_model extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->page_limit = 50;
    }

    public function create($eventsObject)
    {
        $dataToInsert = array(
            'name' => $eventsObject['name'],
            'date' => $eventsObject['date'],
            'max_participants' => $eventsObject['max_participants']
        );

        $this->db->insert('event', $dataToInsert); 

        $id = $this->db->insert_id();
        
        $this->db->reset_query();

		return $id;
    }
}
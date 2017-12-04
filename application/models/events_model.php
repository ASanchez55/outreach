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

        $this->db->insert('events', $dataToInsert); 

        $id = $this->db->insert_id();
        
        $this->db->reset_query();

		return $id;
    }

    public function getEvent($eventId)
    {
        $this->db->select('id, name, max_participants, event_date');
        $this->db->from('events');
        $this->db->where('id', $eventId);

        $query = $this->db->get();

        $this->db->reset_query();

        return $query->result_array();
    }

    public function registerFamily($eventId, $familyId)
    {
        $dataToInsert = array(
            'date_registered' => date('Y-m-d H:i:s'),
            'event_id' => $eventId,
            'family_id' => $familyId
        );

        $this->db->insert('events_families', $dataToInsert);

        $id = $this->db->insert_id();
        
        $this->db->reset_query();

        return $id;
    }
    
    public function getAllEvents()
    {
        $this->db->select('id, name');
    	$this->db->from('events');
        $this->db->order_by('id', 'DESC');
        
        $query = $this->db->get();

        $this->db->reset_query();

        return $query->result_array();
    }
}
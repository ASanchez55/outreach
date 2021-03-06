<?php

class Events_model extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->page_limit = 50;
        $this->load->helper('date');
    }

    public function create($eventsObject)
    {
        $dataToInsert = array(
            'name' => $eventsObject['name'],
            'event_date' => $eventsObject['date'],
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

    public function getEventListRegisteredToFamily($familyId)
    {
        $this->db->select('E.id AS event_id, E.name AS event_name, F.id AS family_id, F.name AS family_name');
        $this->db->from('events_families AS EF');
        $this->db->join('events AS E', 'E.id = EF.event_id', 'inner');
        $this->db->join('families AS F', 'F.id = EF.family_id', 'inner');
        $this->db->where('EF.family_id', $familyId);

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            
        
            $this->db->reset_query();

            return $query->result_array();
        }
        else
        {
            return FALSE;
        }

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

    public function isFamilyRegistered($eventId, $familyId)
    {
        $this->db->select('*');
        $this->db->from('events_families');
        $this->db->where('event_id', $eventId);
        $this->db->where('family_id', $familyId);

        $query = $this->db->get();

        $this->db->reset_query();
        
        if ($query->num_rows() > 0)
        {
            return true;
        }

        return false;
    }

    public function getNumberOfFamiliesRegistered($eventId)
    {
        $this->db->select('*');
        $this->db->from('events_families');
        $this->db->where('event_id', $eventId);

        $query = $this->db->get();

        $this->db->reset_query();
        
        return $query->num_rows();
    }

    public function getNumberOfAttendees($eventId)
    {
        $this->db->select('*');
        $this->db->from('events_family_members');
        $this->db->where('event_id', $eventId);
        $this->db->where('attend', 1);

        $query = $this->db->get();

        $this->db->reset_query();
        
        return $query->num_rows();
    }

    public function findFamiliesRegisteredToEvent($eventId, $familyName)
    {
        $this->db->select('*');
        $this->db->from('families');
        $this->db->join('events_families', 'events_families.family_id = families.id' );
        $this->db->like('families.name', $familyName);
        $this->db->where('events_families.event_id', $eventId);

        $query = $this->db->get();
        
        $this->db->reset_query();
                
        return $query->result_array();
    }

    public function isFamilyMemberAttendingEvent($eventId, $family_member_id)
    {
        $this->db->select('*');
        $this->db->from('events_family_members');
        $this->db->where('event_id', $eventId);
        $this->db->where('family_member_id', $family_member_id);

        $query = $this->db->get();
        
        $this->db->reset_query();

        if ($query->num_rows() > 0)
        {

            /*
            if ($query[0]['attend'] == '1')
            {
                return true;
                //return $query[0]['id'];
            }
            */
            foreach ( $query->result() as $row )
            {
                
                if ($row->attend == 1) 
                {
                    # code...
                    return TRUE;
                }
                
                return FALSE;
            }
        }

        return NULL;
    }

    
    public function getEventAttendee($eventId, $family_member_id)
    {
        $this->db->select('*');
        $this->db->from('events_family_members');
        $this->db->where('event_id', $eventId);
        $this->db->where('family_member_id', $family_member_id);

        $query = $this->db->get();

        $this->db->reset_query();

        if ($query->num_rows() > 0)
        {
            foreach ( $query->result() as $row )
            {
                
                return $row->id;
            }
        }
        else
        {
            return FALSE;
        }

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

    public function updateEventDetails($eventObject, $eventId)
    {
        $this->db->where('id', $eventId);
        $this->db->update('events', $eventObject);

        //reset query builder
        $this->db->reset_query();
    }

    public function registerFamilyMemberAttendanceInsert($familyMemberObject)
    {
        $this->db->insert('events_family_members', $familyMemberObject);

        $this->db->reset_query();
    }

    public function registerFamilyMemberAttendanceUpdate($eventFamilyMemberId, $familyMemberObject)
    {
        $this->db->where('id', $eventFamilyMemberId);
        $this->db->update('events_family_members', $familyMemberObject);

        //reset query builder
        $this->db->reset_query();
    }

    public function removeFamilyMemberAttendance($eventFamilyMemberId)
    {
        $this->db->set('attend', 0);
        $this->db->where('id', $eventFamilyMemberId);
        $this->db->update('events_family_members');

        //reset query builder
        $this->db->reset_query();
    }

    public function removeFamilyToEvent($eventId, $familyId)
    {
        $this->db->where('event_id', $eventId);
        $this->db->where('family_id', $familyId);
        $this->db->delete('events_families');

        //reset query builder
        $this->db->reset_query();

        $this->removeFamilyMembersToEvent($eventId, $familyId);
    }

    public function removeFamilyMembersToEvent($eventId, $familyId)
    {
        $this->db->where('event_id', $eventId);
        $this->db->where('family_id', $familyId);
        $this->db->delete('events_family_members');

        //reset query builder
        $this->db->reset_query();
    }


}
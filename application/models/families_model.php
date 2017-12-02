<?php

class Families_model extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->table_start = '<table>';
        $this->table_end = '</table>';
        $this->row_start = '<tr>';
        $this->row_end = '</tr>';
        $this->col_start = '<td>';
        $this->col_end = '</td>';
        $this->thead_start = '<thead>';
        $this->thead_end = '</thead>';
        $this->tbody_start = '<tbody>';
        $this->tbody_end = '</tbody>';
        $this->page_limit = 50;
    }

    // Creates a family 
    // Returns the $id of the newly inserted family.
    public function createFamily($family_name, $comp_add)
    {
        $dataToInsert = array(
            'name' => $family_name,
            'comp_address' => $comp_add
        );

        $this->db->insert('family', $dataToInsert); 

        $id = $this->db->insert_id();
        
        $this->db->reset_query();

		return $id;
    }

    public function getFamilyNameById($id)
    {
        $select = 'F.name AS lname';
        $table = 'family AS F';

        $this->db->select($select);
        $this->db->from($table);
        $this->db->like('id', $id);

        $query = $this->db->get();
        $name = '';
        
        if ($query->num_rows() != 0) 
		{
            $this->db->reset_query();
            
            foreach ( $query->result() as $row )
			{
                $name = $row->lname;
                break;
            }
        }

        return $name;
    }

    public function findFamilyByName($name)
    {
        $select = 'F.id, F.name AS name';
        $table = 'family AS F';

        $this->db->select($select);
        $this->db->from($table);
        $this->db->like('name', $name);

        $this->db->limit( $this->page_limit );

        $query = $this->db->get();
        $output = '';

        $this->db->reset_query();

        return $query->result_array();
    }
    
    // TODO: Re-write this to return list of family data rather than HTML Table elements.
    public function findFamilyById($id)
    {
    	$select = 'F.id, F.name AS lname';
        $table = 'family AS F';

        $this->db->select($select);
        $this->db->from($table);
        $this->db->where('id', $id);

        $this->db->limit( $this->page_limit );

        $query = $this->db->get();
        $output = '';

        // TODO: this should be done somewhere else
        $add_family_link = 'family/addMember/';
        $register_family_event_link = 'event/registerFamily/';

        if ($query->num_rows() != 0) 
		{
            $this->db->reset_query();
            
            // TODO: Allow UI to parse rather than build UI elements here
            foreach ( $query->result() as $row )
			{
    			$output .= $this->row_start;
    			$output .= $this->col_start.$row->id.$this->col_end;
    			$output .= $this->col_start.$row->lname.$this->col_end;
                $output .= $this->col_start.anchor($add_family_link.$row->id, 'Add').$this->col_end;
                $output .= $this->col_start.anchor($register_family_event_link.$row->id, 'Register').$this->col_end;
    			$output .= $this->row_end;
            }
            
            return $output;
        }
        else
        {
            $output = '';
            return $output;
        }
    }

    // TODO: Db update should change this.
    public function getAllFamilyMembers($familyId)
    {
        $select = 'P.id, P.fname as name, P.gender, P.birth_date as birthday, P.head_family as head_of_family';
        $table = 'participants as P';

        $this->db->select($select);
        $this->db->from($table);
        $this->db->where("P.family_name_id", $familyId);

        $query = $this->db->get();

        // Why reset?
        $this->db->reset_query();

        return $query->result_array();
    }
}
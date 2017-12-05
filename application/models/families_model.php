<?php

class Families_model extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->page_limit = 50;
    }

    // Creates a family 
    // Returns the $id of the newly inserted family.
    public function createFamily($family_name, $comp_add)
    {
        $dataToInsert = array(
            'name' => $family_name,
            'address' => $comp_add
        );

        $this->db->insert('families', $dataToInsert); 

        $id = $this->db->insert_id();
        
        $this->db->reset_query();

		return $id;
    }

    public function getFamilyNameById($id)
    {
        $select = 'F.name AS lname';
        $table = 'families AS F';

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
        $table = 'families AS F';

        $this->db->select($select);
        $this->db->from($table);
        $this->db->like('name', $name);

        $this->db->limit( $this->page_limit );

        $query = $this->db->get();

        $this->db->reset_query();

        return $query->result_array();
    }

    public function getAllFamilyMembers($familyId)
    {
        $select = 'FM.id, FM.full_name as name, FM.gender, FM.birth_date as birthday, FM.head_family as head_of_family';
        $table = 'family_members as FM';

        $this->db->select($select);
        $this->db->from($table);
        $this->db->where("FM.family_id", $familyId);

        $query = $this->db->get();

        // Why reset?
        $this->db->reset_query();

        return $query->result_array();
    }

    public function getFamilyMembersCount($familyId)
    {
        $select = '*';
        $table = 'family_members as FM';

        $this->db->select($select);
        $this->db->from($table);
        $this->db->where("FM.family_id", $familyId);

        $query = $this->db->get();

        // Why reset?
        $this->db->reset_query();

        return $query->num_rows();
    }
}
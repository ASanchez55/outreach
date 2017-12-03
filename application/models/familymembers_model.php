<?php

class FamilyMembers_model extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
        $this->page_limit = 50;
    }

    public function createFamilyMember($familyObject)
    {
        $dataToInsert = array(
            'fname'				=> $familyObject['fname'],
            'family_name_id'	=> $familyObject['family_name_id'],
            'gender'			=> $familyObject['gender'],
            'birth_date'		=> $familyObject['birth_date'],
            'head_family'		=> $familyObject['head_family']
        );

        $this->db->insert('participants', $dataToInsert); 

        $id = $this->db->insert_id();
        
        $this->db->reset_query();

		return $id;
    }

    public function getFamilyMemberDetails($familyMemberId)
    {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->like('name', $name);
    }

}
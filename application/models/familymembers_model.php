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
        /*
        $dataToInsert = array(
            'full_name'			=> $familyObject['fname'],
            'family_id'	        => $familyObject['family_name_id'],
            'gender'			=> $familyObject['gender'],
            'birth_date'		=> $familyObject['birth_date'],
            'head_family'		=> $familyObject['head_family']
        );
        */

        $this->db->insert('family_members', $familyObject); 

        $id = $this->db->insert_id();
        
        $this->db->reset_query();

		return $id;
    }

    public function getFamilyMemberDetails($familyMemberId)
    {
        $this->db->select('id, family_id, full_name, gender, birth_date, head_family');
        $this->db->from('family_members');
        $this->db->where('id', $familyMemberId);

        $query = $this->db->get();

        //reset query builder
        $this->db->reset_query();

        return $query->result_array();

    }

    public function updateFamilyMemberDetails($familyMemberObject, $familyMemberId)
    {

        $this->db->where('id', $familyMemberId);
        $this->db->update('family_members', $familyMemberObject);

        //reset query builder
        $this->db->reset_query();
    }

    public function deleteFamilyMember($familyMemberId)
    {
        $this->db->where('id', $familyMemberId);
        $this->db->delete('family_members');

        //reset query builder
        $this->db->reset_query();
    }

    public function getFamilyHeadAge($eventId, $familyMemberId)
    {
        $query = $this->db->query("
            SELECT *
            FROM family_members 
            WHERE (  YEAR(CURDATE()) - (YEAR(birth_date) + 
            IF (MONTH(CURDATE()) >= MONTH(birth_date), IF(DAY(CURDATE() >= DAY(birth_date)),1,0 ), 0)  ) )  < 12
        "); 

        return $query->result_array();
        
    }

}
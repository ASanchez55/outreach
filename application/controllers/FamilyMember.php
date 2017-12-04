<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FamilyMember extends MY_Controller 
{    
	public function __construct()
    {
        parent::__construct();
	    // Your own constructor code
	    $this->load->model('Model_insert');
	    $this->load->model('Model_return');
	    $this->load->library('form_validation');
	    $this->load->library('viewbag');

        $this->load->model('familymembers_model');
        $this->load->model('families_model');
	    
	    //check if user is logged on
	    $this->load->library('set_custom_session');
	    $this->admin_data = $this->set_custom_session->admin_session();
    }

    public function create()
    {
        $this->data['family_name'] = '';
        $this->data['comp_add'] = '';
        $this->data['date_registered'] = '';
        $this->data['event_list'] = $this->Model_return->event_list();

        $this->render($this->viewbag->family_create());
    }

    public function editFamilyMember($familyMemberId)
    {
        if ($familyMemberId == '')
        {
            // Redirect to home page
            redirect('family');
        }

        $this->data['familyMemberId'] = $familyMemberId;

        
        $this->data['member_details'] = $this->familymembers_model->getFamilyMemberDetails($familyMemberId);
        
        //We have not found a family member!
        if ($this->data['member_details'] == '') 
        {
            # code...
            redirect('family');
        }

        if ($this->input->method() === 'post')
        {
            $this->updateFamilyMember();
        }
        else
        {
             $this->render($this->viewbag->family_member_edit());
        }

       
          
    }

    private function updateFamilyMember()
    {
        
        $config = array(
            array(
                'field' => 'fname',
                'label' => 'First Name',
                'rules' => 'trim|required|xss_clean'
            ),
            array(
                'field' => 'gender',
                'label' => 'Gender',
                'rules' => 'trim|required|xss_clean'
            ),
            array(
                'field' => 'birth_date',
                'label' => 'Birth Date',
                'rules' => 'trim|required|xss_clean'
            ),
            array(
                'field' => 'head_family',
                'label' => 'Head of Family',
                'rules' => 'trim|required|xss_clean'
            )
        );
        
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == false) 
        {
            # code...
            $this->render($this->viewbag->family_member_edit());
            return;
        }
        
        $familyMemberObject = array(
            'full_name'     => strtoupper($this->input->post('lname').', '.$this->input->post('fname')),
            'gender'        => $this->input->post('gender'),
            'birth_date'    => $this->input->post('birth_date'),
            'head_family'   => $this->input->post('head_family')
        );

        $this->familymembers_model->updateFamilyMemberDetails($familyMemberObject, $this->data['familyMemberId']);

        redirect('family/view/'.$this->input->post('family_id'));

        
    }

    public function deleteFamilyMember($familyMemberId)
    {
        $this->data['familyMemberId'] = $familyMemberId;

        $member_details = $this->familymembers_model->getFamilyMemberDetails($familyMemberId);
        
        //We have not found a family member!
        if ($member_details == '') 
        {
            # code...
            redirect('family');
        }

        $this->data['familyId'] = $member_details[0]['family_id'];

        $this->render($this->viewbag->family_member_delete());
    }

    public function deleteConfirmFamilyMember($familyMemberId)
    {
        $member_details = $this->familymembers_model->getFamilyMemberDetails($familyMemberId);
        
        //We have not found a family member!
        if ($member_details == '') 
        {
            # code...
            redirect('family');
        }

        $this->familymembers_model->deleteFamilyMember($familyMemberId);

        redirect('family/view/'.$member_details[0]['family_id']);
    }


}
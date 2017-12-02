<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Family extends MY_Controller 
{    
	public function __construct()
    {
        parent::__construct();
	    // Your own constructor code
        $this->load->model('Model_insert');
        $this->load->model('Model_return');

        $this->load->model('families_model');
        $this->load->model('familymembers_model');

	    $this->load->library('form_validation');
	    $this->load->library('viewbag');
	    
	    //check if user is logged on
	    $this->load->library('set_custom_session');
	    $this->admin_data = $this->set_custom_session->admin_session();
    }

    public function index()
    {
        if ( $this->input->get('searchKeyword') ) 
        {
            $name = $this->input->get('searchKeyword');
        	$this->data['families'] = $this->families_model->findFamilyByName($name);
        	$this->render('family/index');
        }
        else
        {
        	$this->data['families'] = array();
        	$this->render('family/index');
        }
    }

    public function create()
    {
        $this->data['family_name'] = '';
        $this->data['comp_add'] = '';
        $this->render('family/create');
    }

    public function saveFamily()
    {
        // Save only on POST
        if ($this->input->method() === 'post')
        {
            $family_name = $this->input->post('family_name');
            $comp_add = $this->input->post('comp_add');

            $familyIdGenerated = $this->families_model->createFamily($family_name, $comp_add);

            $this->data['family_id'] = $familyIdGenerated;
            $this->data['family_name'] = $family_name;

            $this->render('family/create_success');
        }
        else 
        {
            redirect('family/create');
        }
    }

    public function register()
    {
        $this->data['family_name'] = '';
        $this->data['comp_add'] = '';
        $this->data['date_registered'] = '';
        $this->data['event_list'] = $this->Model_return->event_list();

        $this->render($this->viewbag->family_create());
    }

    public function addFamilyMember($familyId)
    {
        if ($familyId == '')
        {
            // Redirect to home page
            redirect('family');
        }

        // HACK: For some weird reason calling saveFamilyMember
        // with POST doesn't work.
        if ($this->input->method() === 'post')
        {
            $this->saveFamilyMember($familyId);
        }
        else
        {
            $this->data['family_name'] = $this->families_model->getFamilyNameById($familyId);
            $this->data['family_id'] = $familyId;
    
            // TODO: simplify this
    
            //form dropdown for gender
            $options = array(
                'Male'		=> 'Male',
                'Female'	=> 'Female'
            );
            $js = 'class="form-control"';
            $this->data['gender'] =  form_dropdown('gender', $options, '',$js);
    
            //radio button for head of family
            $options = array(
                    'name'          => 'head_family',
                    'value'         => 1,
                    'checked'       => FALSE
            );
    
            $this->data['head_family1'] = form_radio($options);
    
            $options = array(
                    'name'          => 'head_family',
                    'value'         => 0,
                    'checked'       => TRUE
            );
    
            $this->data['head_family2'] = form_radio($options);    
    
            $family_fields = array(
                'fname'				=> $this->input->post('fname'),
                'family_name_id'	=> $familyId,
                'birth_date'		=> $this->input->post('birth_date'),
            );
    
            $this->data = array_merge($this->data, $family_fields);
    
            $this->render('family/add_family_member');
        }
    }

    public function saveFamilyMember($family_id)
    {
        // Save only on POST
        if ($this->input->method() === 'post')
        {
            $familyObject = '';
            $familyObject = array(
				'fname'				=> $this->input->post('fname'),
				'family_name_id'	=> $family_id,
				'gender'			=> $this->input->post('gender'),
				'birth_date'		=> $this->input->post('birth_date'),
				'head_family'		=> $this->input->post('head_family')

            );
            
            $this->familymembers_model->createFamilyMember($familyObject);
            
            redirect('family');
        }
        else
        {
            redirect('family');
        }
    }

    public function view($familyId)
    {
        if ($familyId == '')
        {
            redirect('family');
        }

        $familyName = '';
        $familyName = $this->families_model->getFamilyNameById($familyId);

        // We have not found a family!
        if ($familyName == '')
        {
            redirect('family');
        }

        $families = '';
        $family_members = $this->families_model->getAllFamilyMembers($familyId);

        $this->data['family_name'] = $familyName;
        $this->data['family_id'] = $familyId;
        $this->data['family_members'] = $family_members;

        $this->render('family/view');
    }
}
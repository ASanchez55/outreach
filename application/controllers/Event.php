<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends MY_Controller 
{    
	public function __construct()
    {
	    parent::__construct();
	    // Your own constructor code
        $this->load->model('events_model');
        $this->load->model('families_model');
        $this->load->model('familymembers_model');

	    $this->load->library('form_validation');
        $this->load->library('set_custom_session');
        $this->load->library('set_views');
    }

    public function create()
    {
		$this->data['event_name'] = '';
        $this->data['event_date'] = '';
        $this->data['max_participants'] = '';
        
        $this->render('event/create');
    }

    public function view($eventId)
    {
        if ($eventId == '')
        {
            redirect('event/find');
        }

        $event = $this->events_model->getEvent($eventId);
        
        $this->data['event'] = $event[0];
        $this->data['number_of_families_registered'] 
            = $this->events_model->getNumberOfFamiliesRegistered($eventId);

        if ($this->input->method() != 'post')
        {
            $this->data['families'] = array(); 
            $this->render('event/view');
            return;
        }
        else
        {
            $familyName = $this->input->post('family_name');

            $this->data['families'] 
                = $this->events_model->getAllFamiliesRegisteredToEvent($familyName);

            // Use of & is to modify the foreach variable. Not recommended but it works.
            foreach($this->data['families'] as &$family)
            {
                $family_members = $this->families_model->getAllFamilyMembers($family['id']);

                // Use of & is to modify the foreach variable. Not recommended but it works.
                foreach($family_members as &$family_member)
                {
                    $family_member['attending'] = $this->events_model->isFamilyMemberAttendingEvent($eventId, $family_member['id']);
                }

                $family['family_members'] = $family_members;
            }

            $this->render('event/view');
        }
    }

    public function find()
    {
        $events = $this->events_model->getAllEvents();
        
        if ($events == '')
        {
            // Make sure that we have an existing event first!
            redirect('event/create');
        }

        $this->data['events'] = $events;
        
        $this->render('event/find');
    }

    public function findSubmit()
    {
        if ($this->input->method() != 'post')
        {
            redirect('event/find');
        }

        $event_id_selected = $this->input->post('event_id_selected');

        if ($event_id_selected == '')
        {
            redirect('event/find');
        }

        redirect('event/view/'.$event_id_selected);
    }

    public function saveEvent()
    {
        if ($this->input->method() != 'post')
        {
            redirect('event/create');
        }

        $config = array(
                array(
                    'field' => 'event_name',
                    'label' => 'Event Name',
                    'rules' => 'trim|required|xss_clean'
                ),
                array(
                    'field' => 'event_date',
                    'label' => 'Event Date',
                    'rules' => 'required|xss_clean'
                ),
                array(
                    'field' => 'max_participants',
                    'label' => 'Maximum Number of Participants',
                    'rules' => 'numeric|required|xss_clean'
                )
        ); 
		$this->form_validation->set_rules($config);

		if ( $this->form_validation->run() == TRUE )
		{
            $eventObject = array(
				'name' 	=> $this->input->post('event_name'),
                'date'	=> $this->input->post('event_date'), 
                'max_participants' => $this->input->post('max_participants')
            );

            $eventId = $this->events_model->create($eventObject);

			$this->render('event/create_event_success');
        }
        else
		{
            // Re-populate with submitted items.
			$this->data['event_name'] = $this->input->post('event_name');
            $this->data['event_date'] = $this->input->post('event_date');
            $this->data['max_participants'] = $this->input->post('max_participants');
            
			$this->render('event/create');
		}
    }

    public function register($familyId)
    {
        $familyName = $this->families_model->getFamilyNameById($familyId);

        if ($familyName == '')
        {
            // Redirect to Family-index if we are given an invalid family.
            redirect('family');
        }

        $events = $this->events_model->getAllEvents();

        if ($events == '')
        {
            // Make sure create an event.
            redirect('event/create');
        }

        $this->data['family_name'] = $familyName;
        $this->data['family_id'] = $familyId;
        $this->data['events'] = $events;

        $this->render('event/register');
    }

    public function registerFamily()
    {
        if ($this->input->method() != 'post')
        {
            redirect('event/register');
        }

        $eventId = $this->input->post('event_id');
        $familyId = $this->input->post('family_id');

        $number_of_families_registered
            = $this->events_model->getNumberOfFamiliesRegistered($eventId);
        $event 
            = $this->events_model->getEvent($eventId);

        // Is the Event full?
        if ($number_of_families_registered >= $event[0]['max_participants'])
        {
            $this->render('event/event_full');
            return;
        }
        else
        {
            // Is family already registered?
            if ($this->events_model->isFamilyRegistered($eventId, $familyId))
            {
                $this->render('event/already_registered');
                return;
            }
            else
            {
                $id = $this->events_model->registerFamily($eventId, $familyId);
                $this->render('event/registration_success');
                return;
            }
        }
    }
}

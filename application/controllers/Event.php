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
        $this->load->library('viewbag');
        $this->load->library('set_views');

        $this->load->helper('date');
    }

    public function create()
    {
        /*
		$this->data['event_name'] = '';
        $this->data['event_date'] = '';
        $this->data['max_participants'] = '';
        */
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

        $this->data['number_of_family_members_attending'] = $this->events_model->getNumberOfAttendees($eventId);
        $this->data['number_of_families_attending'] = 0;
        $this->data['familyName'] = '';

        if ($this->input->method() == 'get')
        {
            $this->data['familyName'] = $this->input->get('family_name');
        }
        else
        {
            $this->data['familyName'] = $this->input->post('family_name');
        }

        $this->data['families'] 
            = $this->events_model->findFamiliesRegisteredToEvent($eventId, $this->data['familyName']);

        // Use of & is to modify the foreach variable. Not recommended but it works.
        foreach($this->data['families'] as &$family)
        {
            $family_members = $this->families_model->getAllFamilyMembers($family['family_id']);

            // Use of & is to modify the foreach variable. Not recommended but it works.
            $isAFamilyMemberAttending = false;
            foreach($family_members as &$family_member)
            {
                $family_member['attending'] = $this->events_model->isFamilyMemberAttendingEvent($eventId, $family_member['id']);
                if ($family_member['attending'] == TRUE)
                {
                    $isAFamilyMemberAttending = TRUE;
                }
            }
            
            if ($isAFamilyMemberAttending)
            {
                $this->data['number_of_families_attending'] += 1;
            }

            $family['family_members'] = $family_members;
        }

        $this->render('event/view');
    }

    public function find()
    {
        $events = $this->events_model->getAllEvents();
        
        if (empty($events))
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
            //form helper set value will handle the re-population set_value($field[, $default = ''[, $html_escape = TRUE]])
            // Re-populate with submitted items.
            /*
			$this->data['event_name'] = $this->input->post('event_name');
            $this->data['event_date'] = $this->input->post('event_date');
            $this->data['max_participants'] = $this->input->post('max_participants');
            */
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
        
        if (empty($events))
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

    public function unregisterFamily($familyId)
    {
        if ($familyId == '') 
        {
            # code...
            redirect('family');
        }
        $this->data['familyId'] = $familyId;

        $this->data['events'] = $this->events_model->getEventListRegisteredToFamily($familyId);

        //We have not found registered event
        if ($this->data['events'] == '') 
        {
            # code...
            redirect('family');
        }

        

        $this->render($this->viewbag->unregister_event());
    }

    public function unregisterConfirmFamily()
    {
        if ($this->input->method() != 'post')
        {
            redirect('family');
        }

        $eventId = $this->input->post('event_id');
        $familyId = $this->input->post('family_id');



        $isRegistered = $this->events_model->isFamilyRegistered($eventId, $familyId);
        
        //We have not found a family!
        if ($isRegistered == '') 
        {
            # code...
            redirect('family');
        }

        $this->events_model->removeFamilyToEvent($eventId, $familyId);

        
        $this->render('event/unregister_success');
    }

    public function editEvent()
    {
        if ($this->input->method() != 'post')
        {
            redirect('event/find');
        }

        $this->data['event_details'] = $this->events_model->getEvent($this->input->post('event_id_selected'));

        //We have not found an event!
        if ($this->data['event_details'] == '') 
        {
            # code...
            redirect('event/find');
        }

        if ($this->input->method() === 'post')
        {
            $this->updateEvent();
        }
        else
        {
            $this->render($this->viewbag->edit_event());
        }

        
    }

    private function updateEvent()
    {
        $config = array(
            array(
                'field' => 'event_name',
                'label' => 'Event Name',
                'rules' => 'trim|required|xss_clean'
            ),
            array(
                'field' => 'event_date',
                'label' => 'Event Date',
                'rules' => 'trim|required|xss_clean'
            ),
            array(
                'field' => 'max_participants',
                'label' => 'Max Participants',
                'rules' => 'trim|required|xss_clean'
            )
        );
        
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == false) 
        {
            # code...
            $this->render($this->viewbag->edit_event());
            return;
        }

        $eventObject = array(
            'name'               => $this->input->post('event_name'),
            'event_date'         => $this->input->post('event_date'),
            'max_participants'   => $this->input->post('max_participants')
        );

        $this->events_model->updateEventDetails($eventObject, $this->input->post('event_id'));

        redirect('event/find');
    }

    public function registerFamilyMemberToEvent()
    {
        if ($this->input->method() != 'get')
        {
            redirect('event/find');
        } 

        $familyId       = $this->input->get('family_id');
        $familyMemberId = $this->input->get('family_member_id');
        $eventId        = $this->input->get('event_id');
        $familyName     = $this->input->get('family_name');

        /*
        // datechecker
        $isEventDay = $this->events_model->getEvent($eventId);
        
        if ($isEventDay[0]['event_date'] != mdate('%Y-%m-%d', time())) 
        {
            # code...
            redirect('event/find');
        }
        */
        $familyMemberObject = array(
            'event_id'          => $eventId,
            'family_id'         => $familyId,
            'family_member_id'  => $familyMemberId,
            'date_attended'     => mdate('%Y-%m-%d', time()),
            'attend'            => 1 
        );

        $memberDetails = $this->familymembers_model->getFamilyMemberDetails($familyMemberId);

        //check data
        if ($memberDetails != '') 
        {
            # code...
            if ($familyId == $memberDetails[0]['family_id']) 
            {
                # code...

                //check if family is registered to the event
                $isRegistered = $this->events_model->isFamilyRegistered($eventId, $familyId);
                if ($isRegistered == TRUE) 
                {
                    # code...
                    //check if the data of family member is already stored
                    $isAttending = $this->events_model->isFamilyMemberAttendingEvent($eventId, $familyMemberId);

                    if ( is_null($isAttending) ) 
                    {
                        # code...
                        //Insert
                        $this->events_model->registerFamilyMemberAttendanceInsert($familyMemberObject);
                       
                    }
                    else
                    {
                         //Update 
                        $eventFamilyMemberId = $this->events_model->getEventAttendee($eventId, $familyMemberId);

                        $this->events_model->registerFamilyMemberAttendanceUpdate($eventFamilyMemberId, $familyMemberObject);
                    }

                    redirect('event/view/'.$eventId.'?family_name='.$familyName);
                }
                else
                {
                    redirect('event/find');
                }
            }
            else
            {
                redirect('');
            }
        }
        else
        {
            redirect('event/find');
        }

    }

    public function removeFamilyMemberToEvent()
    {
        if ($this->input->method() != 'get')
        {
            redirect('event/find');
        } 

        //$familyId       = $this->input->get('family_id');
        $familyMemberId = $this->input->get('family_member_id');
        $eventId        = $this->input->get('event_id');
        $familyName     = $this->input->get('family_name');

        $eventFamilyMemberId = $this->events_model->getEventAttendee($eventId, $familyMemberId);

        if ($eventFamilyMemberId == 0) 
        {
            # code...
            redirect('event/find');
        }

        $this->events_model->removeFamilyMemberAttendance($eventFamilyMemberId);
        redirect('event/view/'.$eventId.'?family_name='.$familyName);
    } 

}// end class

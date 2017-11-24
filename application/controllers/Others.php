<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Others extends CI_Controller 
{

	public function __construct()
    {
	    parent::__construct();
	    // Your own constructor code
	   
    }

    function address()
	{
		$this->load->model('Model_others');
		
		
		if($this->input->get('type') && $this->input->get('value'))
		{
			$type = $this->input->get('type');
			$value = $this->input->get('value');
			
			
			$output = $this->Model_others->address_condition($type, $value);
			
			echo $output;
		}// end of main if
	}
	
	
	
	

}//end class
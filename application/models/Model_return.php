<?php
class Model_return extends CI_Model {

	private $table_start;
	private $table_end;
	private $row_start;
	private $row_end;
	private $col_start;
	private $col_end;
	private $page_limit;
	private $thead_start;
	private $thead_end;
	private $tbody_start;
	private $tbody_end;

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

	public function return_family($data)
	{
		$this->db->select('name');
    	$this->db->from('family');
    	$this->db->where('id', $data);

    	$query = $this->db->get();

        if ($query->num_rows() == 1 ) 
        {
        	//reset query builder
            $this->db->reset_query();

            foreach ( $query->result() as $row )
            {
            	$output = $row->name;
            }

            return $output;

        }
        else
        {
        	return FALSE;
        }

	}



	public function return_participants($data)
	{
		$this->db->select('P.fname, F.name AS lname, P.head_family');
    	$this->db->from('participants AS P');
    	$this->db->join('family AS F', 'F.id = P.family_name_id');
    	$this->db->where('P.family_name_id', $data);

    	$query = $this->db->get();

        if ($query->num_rows() >= 1 ) 
        {
        	//reset query builder
            $this->db->reset_query();

            //$output = $this->table_start;
            $output = $this->thead_start;
            $output .= $this->row_start;
            $output .= $this->col_start.'First Name'.$this->col_end;
            $output .= $this->col_start.'Last Name'.$this->col_end;
            $output .= $this->col_start.'Head of family'.$this->col_end;
            $output .= $this->row_end;
            $output .= $this->thead_end;
            $output .= $this->tbody_start;

            foreach ( $query->result() as $row )
            {

            	if ($row->head_family == 1) 
            	{
            		# code...
            		$boolean_yes_no = 'Yes';
            	}
            	else
            	{
            		$boolean_yes_no = 'No';
            	}
            	
            	$output .= $this->row_start;
            	$output .= $this->col_start.$row->fname.$this->col_end;
            	$output .= $this->col_start.$row->lname.$this->col_end;
            	$output .= $this->col_start.$boolean_yes_no.$this->col_end;
            	$output .= $this->row_end;
            }

            //$output .= $this->table_end;
            $output .= $this->tbody_end;
            return $output;

        }
        else
        {
        	return FALSE;
        }
	}// end return participants

	public function return_event($data)
	{
		$this->db->select('name, date');
    	$this->db->from('event');

    	$query = $this->db->get();

        if ($query->num_rows() >= 1 ) 
        {
        	//reset query builder
            $this->db->reset_query();

            //$output = $this->table_start;
            $output = $this->thead_start;
            $output .= $this->row_start;
            $output .= $this->col_start.'Event Name'.$this->col_end;
            $output .= $this->col_start.'Event Date'.$this->col_end;
            $output .= $this->row_end;
            $output .= $this->thead_end;
            $output .= $this->tbody_start;

            foreach ( $query->result() as $row )
            {

            	$output .= $this->row_start;
            	$output .= $this->col_start.$row->name.$this->col_end;
            	$output .= $this->col_start.$row->date.$this->col_end;
            	$output .= $this->row_end;
            }

            //$output .= $this->table_end;
            $output .= $this->tbody_end;
            return $output;

        }
        else
        {
        	return FALSE;
        }
	}

	public function event_list()
	{
		$this->db->select('id, name');
    	$this->db->from('event');
    	$this->db->order_by('id', 'DESC');
    	
    	$query = $this->db->get();

        if ($query->num_rows() >= 1 ) 
        {
        	//reset query builder
            $this->db->reset_query();

            foreach ( $query->result() as $row )
            {
            	$options[$row->id] = $row->name;
            }

            $js = 'class="form-control" id="sel1"';
			return form_dropdown('event', $options, '', $js);

        }
        else
        {
        	return FALSE;
        }
	}


	public function search($data)
    {
    	$search_value = $data['search_value'];
    	
    	//check what type eg. deparment, job list, etc.
    	if ( $data['type'] == 'family') 
    	{
    		# code...
    		$add_family_link = 'family/addFamilyMember/';
    		$register_family_event_link = 'Form/register_family_event/';
    		$select_value = 'F.id, F.name AS lname';
            $where_value = "`F`.`id` LIKE '%$search_value%' ESCAPE '!' OR `F`.`name` LIKE '%$search_value%' ESCAPE '!'";

            //$select_value = 'F.id, P.fname, F.name AS lname';
    		//$where_value = "P.head_family = 1 AND ( `F`.`id` LIKE '%$search_value%' ESCAPE '!' OR `F`.`name` LIKE '%$search_value%' ESCAPE '!')";
            //$this->db->join('participants AS P', 'F.id = P.family_name_id');
    		/*
    		$array_like = array(
    			'F.id'  =>	$search_value,
				'F.name'	=>	$search_value
    		);
    		*/
    		//$this->db->where($this->db->or_like( $array_like ));

    		/*
    		$output = $this->table_start;
    		$output .= $this->row_start;
    		$output .= $this->col_start.'ID'.$this->col_end;
    		$output .= $this->col_start.'Family Name'.$this->col_end;
    		$output .= $this->col_start.'Head of the family'.$this->col_end;
    		$output .= $this->col_start.'Add Member'.$this->col_end;
    		$output .= $this->row_end;
    		*/
    		$output = '';
    		

    	}
        


    	$this->db->select( $select_value );
		$this->db->from( $data['table'] );
		$this->db->where($where_value);
		//
		$this->db->limit( $this->page_limit );
		$query = $this->db->get();

		if ($query->num_rows() != 0) 
		{
			# code...
			//reset query builder
			$this->db->reset_query();

			foreach ( $query->result() as $row )
			{

                if ($data['type'] == 'family') 
                {
                    # code...
                
    				$output .= $this->row_start;
    				$output .= $this->col_start.$row->id.$this->col_end;
    				$output .= $this->col_start.$row->lname.$this->col_end;
    				//$output .= $this->col_start.$row->fname.$this->col_end;
                    $output .= $this->col_start.anchor($add_family_link.$row->id, 'Add').$this->col_end;
                    $output .= $this->col_start.anchor($register_family_event_link.$row->id, 'Register').$this->col_end;
    				$output .= $this->row_end;
                }
               
			}

			//$output .= $this->table_end;
			return $output;

		}//end check rows
		else
		{
			$output = $this->row_start;
			$output .= $this->col_start.'No Data'.$this->col_end;
			$output .= $this->row_end;

			return $output;
		}
    }//end search

    public function event_attendance_checker($data)
    {
    	$this->db->select('id');
    	$this->db->from('event_attendance');
    	$this->db->where('family_id', $data['family_id']);
    	$this->db->where('event_id', $data['event_id']);

    	$query = $this->db->get();

        if ($query->num_rows() >= 1 ) 
        {
        	
			return TRUE;

        }
        else
        {
        	return FALSE;
        }
    }




}// end class
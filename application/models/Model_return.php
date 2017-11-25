<?php
class Model_return extends CI_Model {

	private $table_start;
	private $table_end;
	private $row_start;
	private $row_end;
	private $col_start;
	private $col_end;

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

            $output = $this->table_start;
            $output .= $this->row_start.$this->col_start.'First Name'.$this->col_end.$this->col_start.'Last Name'.$this->col_end.$this->col_start.'Head of family'.$this->col_end.$this->row_end;

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

            $output .= $this->table_end;
            return $output;

        }
        else
        {
        	return FALSE;
        }
	}


}
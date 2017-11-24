<?php 

class Model_others extends CI_Model
{	

	public function __construct()
	{
	        parent::__construct();
	        // Your own constructor code
	}
	
	function address_condition($type, $value)
	{
		if(($type == "Address_Province") || ($type == "Address_City"))
		{
			
			if($type == "Address_Province")
			{
				$select_value_1 = 'citymunDesc';
				$select_value_2 = 'citymunCode';
				$table_value = 'refcitymun';
				$where_value = 'provCode';
				$js_type = 'Address_City';
				$type = 'Address_City';
				$name = 'City';
			}
			else
			{
				$select_value_1 = "brgyDesc";
				$select_value_2 = "brgyCode";
				$table_value = "refbrgy";
				$where_value = "citymunCode";
				$type = "Address_Barangay";
				$js_type = "NULL";
				$name = 'Barangay';
			}
			
					
			$this->db->select($select_value_1);
			$this->db->select($select_value_2);
			$this->db->from($table_value);
			$this->db->where($where_value, $value); 
			$query = $this->db->get();
			
			if ($query->num_rows() >= 1 ) 
        	{
        		//reset query builder
	            $this->db->reset_query();
			
				$options = array();
				$options[''] = 'Select '.$name;
				
				foreach ($query->result() as $row)
				{
					$options[$row->$select_value_2] = $row->$select_value_1;
				}
				
				$js = 'id="sel1" onChange="address(\''.$js_type.'\', this.value)"';
				return form_dropdown($type, $options, '', $js);
			}
			else
			{
				return FALSE;
			}
			
		}//end of main if
		else
		{
			return FALSE;
		}
		
	}
	 
	function address_province( $selected )
	{
		$this->db->select("provDesc, provCode");
		$this->db->from("refprovince");
		$this->db->order_by("provDesc", "ASC"); 
		$query = $this->db->get();

		if ($query->num_rows() >= 1 ) 
        {
        	//reset query builder
            $this->db->reset_query();

        	$options = array();
			$options[''] = 'Select Province';
		
			foreach ($query->result() as $row)
			{
				$options[$row->provCode] = $row->provDesc;
			}
	

			$js = 'class="form-control" id="sel1" onChange="address(\'Address_Province\', this.value)"';
			return form_dropdown('Address_Province', $options, $selected, $js);
        }
        else
        {
        	return FALSE;
        }

	}//end function address province
	
	


}


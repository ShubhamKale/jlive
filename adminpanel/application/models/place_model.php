<?php
class place_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
	//$tables=array("atm","bank","cinema","education","food","garden","hospital","hotel","medical","petrol","sport","transport");
    public function __construct()
    {
        $this->load->database();
    }
	
	function store_place($tablename,$data)
    {
		$insert = $this->db->insert($tablename, $data);
	    return $insert;
	}
	
	function count_places($order)
    {
	
		$tables=array("atm","bank","cinema","education","food","garden","hospital","hotel","medical","petrol","sport","transport");
		$i=0;
		$count=0;
		
		//while($i<count($tables))
		//{
			//$query = "SELECT * FROM ".$tables[$i];//." WHERE name like '%$title%' OR search like '%$title%'";
			$this->db->select('*');
			$this->db->from($order);
			$result = $this->db->get();
			$found=$result->num_rows();
			//if($found>0)
			//{
			//	$count = $count + $found;
			//}
			//$i++;
		//}	

		/*$this->db->select('*');
		$this->db->from('manufacturers');
		if($search_string){
			$this->db->like('name', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows(); */
		return $found;
    }
	
	public function get_places($order=null, $limit_start=null, $limit_end=null)
    {
	   		
		$tables=array("atm","bank","cinema","education","food","garden","hospital","hotel","medical","petrol","sport","transport");
		$i=0;
		$count=0;
		$resultarray=array();
		//while($i<count($tables))
		//{
			$this->db->select('*');
			$this->db->from($order);
			if($limit_start && $limit_end){
          			$this->db->limit($limit_start,$limit_end);	
        		}
			if($limit_start != null){
          			$this->db->limit($limit_start,$limit_end);    
        		}
        	
			$result = $this->db->get();
			$found=$result->num_rows();
			//if($found>0)
			//{
				$resultarray=$result->result_array();
			//	$count = $count + $found;
			//}
			//$i++;
	//}	
		/*if($search_string){
			$this->db->like('name', $search_string);
		}
		$this->db->group_by('id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}

        if($limit_start && $limit_end){
          $this->db->limit($limit_start, $limit_end);	
        }

        if($limit_start != null){
          $this->db->limit($limit_start, $limit_end);    
        }
        
		$query = $this->db->get();
		
		return $query->result_array(); 	*/
		return $resultarray;
    }
	
	 public function get_place_by_id($id,$table)
    {
		//$tables=array("atm","bank","cinema","education","food","garden","hospital","hotel","medical","petrol","sport","transport");
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }  

	function update_place($id, $table, $data)
    {
		$this->db->where('id', $id);
		$this->db->update($table, $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
	
	function delete_place($id,$table){
		//$tables=array("atm","bank","cinema","education","food","garden","hospital","hotel","medical","petrol","sport","transport");
		$this->db->where('id', $id);
		$this->db->delete($table); 
	}
	
	
	
}
?>
<?php
class Data_Model extends CI_Model{

	Public function __construct() { 
         parent::__construct(); 
         $this->load->database();
      } 	

    Public function insert($table_name,$data){
    	if($this->db->insert($table_name,$data)){
    		return true;
    	}

    } 
    Public function update($table_name,$data,$where_condition){
    	$this->db->where($where_condition);
		if($this->db->update($table_name,$data)){
    		return true;
    	}

    } 
	
}
?>
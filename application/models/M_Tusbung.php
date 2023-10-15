<?php
class M_Tusbung extends CI_Model {
    
	var $tb = "tusbung_kumulatif";
	var $id = "id_tusbung_kumulatif";
	
	function __construct()
	{
		parent::__construct();	
	}
    
    
	
	
	function cek($where){	// cek data berdasarkan username dan password	
		return $this->db->get_where($this->tb,$where);
	}
	
	
	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data  
	function insert_multiple($data)
	{    
		$this->db->insert_batch($this->tb, $data);  
	}
	
}		
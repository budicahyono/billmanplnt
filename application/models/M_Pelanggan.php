<?php
class M_Pelanggan extends CI_Model {
    
	var $tb = "pelanggan";
	var $id = "id_pelanggan";
	
	function __construct()
	{
		parent::__construct();	
	}
        
	
	function get_all() // ambil semua data unit 
	{
		return $this->db->get($this->tb);
	}
	
	
	function edit($data, $key)
	{
		$this->db->where($this->id, $key);
		$this->db->update($this->tb, $data);
	}
	
	
    //cek id pelanggan 
	function cek($id_pelanggan)
	{
		return $this->db->get_where($this->tb, array($this->id => $id_pelanggan));
	}
	
	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data  
	function insert_multiple($data)
	{    
		$this->db->insert_batch($this->tb, $data);  
	}
	
}		
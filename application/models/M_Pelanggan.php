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
	
	function get_by_unit($id_unit)
	{
		return $this->db->get_where($this->tb, array('id_unit' => $id_unit));
	}
	
	
	function edit($data, $key)
	{
		$this->db->where($this->id, $key);
		$this->db->update($this->tb, $data);
	}
	
	
	function hapus_by_unit($key) // hapus data pelanggan by unit
	{
		$this->db->delete($this->tb, array('id_unit' => $key)); 
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
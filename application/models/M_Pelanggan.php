<?php
	class M_Pelanggan extends CI_Model	{
		var $tb = "pelanggan";
		var $id = "id_pelanggan";
		
		
		
		function get_all()
		{	// ambil semua data pelanggan 
			return $this->db->get($this->tb);
		}
		
		
		
		function get_by_unit($id_unit)
		{	// ambil data pelanggan by unit 
			return $this->db->get_where($this->tb, array('id_unit' => $id_unit));
		}
		
		
		
		function edit($data, $id_pelanggan)
		{	// edit satu data pelanggan
			$this->db->where($this->id, $id_pelanggan);
			$this->db->update($this->tb, $data);
		}
		
		
		
		function hapus_by_unit($id_unit) 
		{	// hapus data pelanggan by unit
			$this->db->delete($this->tb, array('id_unit' => $id_unit)); 
		}
		
		
		
		function cek($id_pelanggan)
		{	//cek pelanggan 
			return $this->db->get_where($this->tb, array($this->id => $id_pelanggan));
		}
		
		
		
		function insert_multiple($data)
		{    // insert lebih dari 1 data pelanggan
			$this->db->insert_batch($this->tb, $data);  
		}
		
		
		
	}			
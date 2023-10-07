<?php
	class M_Unit extends CI_Model{
		var $tb = "unit";
		var $id = "id_unit";
		
		
		
		
		function get_all() // ambil semua data unit 
		{
			return $this->db->get($this->tb);
		}
		
		
		function post($data) // input data
		{
			$this->db->insert($this->tb,$data);
		}	
		function hapus($key) // hapus data data
		{
			$this->db->delete($this->tb, array($this->id => $key)); 
		}
		
		
		function get_one($key)
		{
			return $this->db->get_where($this->tb, array($this->id => $key));
		}
		function edit($data, $key)
		{
			$this->db->where($this->id, $key);
			$this->db->update($this->tb, $data);
		}
		
		
		
		
	}	
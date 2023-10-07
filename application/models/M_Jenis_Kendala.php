<?php
	class M_Jenis_Kendala extends CI_Model{
		var $tb = "jenis_kendala";
		var $id = "id_jenis_kendala";
		
		
		
		
		function get_all() // ambil semua data jenis_kendala 
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
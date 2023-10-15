<?php
	class M_Rp_Kategori extends CI_Model{
		var $tb = "rp_kategori";
		var $id = "id_rp_kategori";
		
		
		
		
		function get_all() // ambil semua data rp_kategori 
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
		function cek($rptag)
		{
			 $this->db->where('rp_bawah <=', $rptag);
			 $this->db->where('rp_atas >=', $rptag);
			 return $this->db->get($this->tb);
			
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
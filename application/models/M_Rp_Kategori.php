<?php
	class M_Rp_Kategori extends CI_Model	{
		var $tb = "rp_kategori";
		var $id = "id_rp_kategori";
		
		
		
		function get_all() 
		{	// ambil semua data rp_kategori 
			return $this->db->get($this->tb);
		}
		
		
		
		function post($data) 
		{	// input data
			$this->db->insert($this->tb,$data);
		}
		
		
		
		function hapus($id_rp_kategori)
		{	// hapus data rp_kategori
			$this->db->delete($this->tb, array($this->id => $id_rp_kategori)); 
		}
		
		
		
		function cek($rptag)
		{	// cek rptag antara rp_bawah dan rp_atas  
			$this->db->where('rp_bawah <=', $rptag);
			$this->db->where('rp_atas >=', $rptag);
			return $this->db->get($this->tb);
		}
		
		
		
		function get_one($id_rp_kategori)
		{	// ambil 1 data rp_kategori 
			return $this->db->get_where($this->tb, array($this->id => $id_rp_kategori));
		}
		
		
		
		function edit($data, $id_rp_kategori)
		{	// edit satu data rp_kategori
			$this->db->where($this->id, $id_rp_kategori);
			$this->db->update($this->tb, $data);
		}
		
		
		
	}	
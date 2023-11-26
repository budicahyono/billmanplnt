<?php
	class M_Jenis_Kendala extends CI_Model	{
		var $tb = "jenis_kendala";
		var $id = "id_jenis_kendala";
	
		
		
		function get_all() 
		{	// ambil semua data jenis_kendala selain yang namanya kosong
			$this->db->where('nama_jenis_kendala !=', ""); 
			return $this->db->get($this->tb);
			//nama kosong itu tidak boleh dihapus, 
			//karena itu adalah pilihan ketika belum ada kendala / evidence 0
		}
		
		
		
		function post($data) 
		{	// input data
			$this->db->insert($this->tb,$data);
		}	
		
		
		
		function hapus($id_jenis_kendala) 
		{	// hapus data jenis_kendala
			$this->db->delete($this->tb, array($this->id => $id_jenis_kendala)); 
		}
		
		
		
		function get_one($id_jenis_kendala)
		{	// ambil satu data jenis_kendala
			return $this->db->get_where($this->tb, array($this->id => $id_jenis_kendala));
		}
		
		
		
		function get_by_nama($kendala)
		{	// ambil satu data jenis_kendala by nama_jenis_kendala
			return $this->db->get_where($this->tb, array("nama_jenis_kendala" => $kendala));
		}
		
		
		
		function edit($data, $id_jenis_kendala)
		{	// edit satu data jenis_kendala
			$this->db->where($this->id, $id_jenis_kendala);
			$this->db->update($this->tb, $data);
		}
		
		
		
	}	
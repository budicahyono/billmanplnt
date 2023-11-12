<?php
	class M_Petugas extends CI_Model{
		var $tb = "petugas";
		var $id = "id_petugas";
		
		
		
		
		function get_all() // ambil semua data petugas 
		{
			$this->db->join('unit', 'unit.id_unit = petugas.id_unit');
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
		
		function cek($nama)
		{
			return $this->db->get_where($this->tb, array("nama_petugas" => $nama));
		}
		
		
		function by_unit($key, $is_petugas_khusus = null)
		{
			$this->db->join('unit', 'unit.id_unit = petugas.id_unit');
			$this->db->where("unit.id_unit", $key);
			if ($is_petugas_khusus == null) {
				$this->db->where("is_petugas_khusus", 0);
			} else {
				$this->db->where("is_petugas_khusus", $is_petugas_khusus);
			}
			return $this->db->get($this->tb);
		}
		function edit($data, $key)
		{
			$this->db->where($this->id, $key);
			$this->db->update($this->tb, $data);
		}
		
		
		
		
	}	
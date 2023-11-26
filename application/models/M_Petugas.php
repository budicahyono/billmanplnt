<?php
	class M_Petugas extends CI_Model	{
		var $tb = "petugas";
		var $id = "id_petugas";
		
		
		
		function get_all() 
		{	// ambil semua data petugas 
			$this->db->join('unit', 'unit.id_unit = petugas.id_unit');
			return $this->db->get($this->tb);
		}
		
		
		
		function post($data) 
		{	// input data
			$this->db->insert($this->tb,$data);
		}	
		
		
		
		function hapus($id_petugas) 
		{	// hapus data petugas
			$this->db->delete($this->tb, array($this->id => $id_petugas)); 
		}
		
		
		
		function get_one($id_petugas)
		{	// ambil 1 data petugas 
			return $this->db->get_where($this->tb, array($this->id => $id_petugas));
		}
		
		
		
		function cek($nama)
		{	//cek petugas by nama
			return $this->db->get_where($this->tb, array("nama_petugas" => $nama));
		}
		
		
		
		function by_unit($id_unit, $is_petugas_khusus = null)
		{	// ambil data petugas by id_unit
			$this->db->join('unit', 'unit.id_unit = petugas.id_unit');
			$this->db->where("unit.id_unit", $id_unit);
			if ($is_petugas_khusus == null) {
				$this->db->where("is_petugas_khusus", 0);
			} else {
				$this->db->where("is_petugas_khusus", $is_petugas_khusus);
			}
			return $this->db->get($this->tb);
		}
		
		
		
		function edit($data, $id_petugas)
		{	// edit satu data petugas
			$this->db->where($this->id, $id_petugas);
			$this->db->update($this->tb, $data);
		}
		
		
		
	}	
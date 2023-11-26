<?php
	class M_Kendala_Harian extends CI_Model	{
		var $tb = "kendala_harian";
		var $id = "id_kendala_harian";
		
		
		
		function post($data) 
		{	// input data
			$this->db->insert($this->tb,$data);
		}	
		
		
		
		function edit($data, $id_kendala_harian)
		{	// edit satu data kendala_harian
			$this->db->where($this->id, $id_kendala_harian);
			$this->db->update($this->tb, $data);
		}
		
		
		
		function get_kendala_harian($id_petugas, $tgl, $id_petugas_khusus = null) 
		{	// ambil kendala_harian by id_petugas
			$tanggal = $_SESSION['tahun_sess']."-".$_SESSION['bulan_sess']."-".$tgl;
			
			if ($id_petugas_khusus == null) {
				$this->db->where("id_petugas", $id_petugas);
				} else {
				$this->db->where("id_petugas", $id_petugas_khusus);
			}
			$this->db->where("tgl_kendala", $tanggal);
			return $this->db->get($this->tb);
		}
		
		
		
		function hapus($tgl) 
		{	// hapus data kendala_harian by tgl
			$tanggal = $_SESSION['tahun_sess']."-".$_SESSION['bulan_sess']."-".$tgl;
			$this->db->delete($this->tb, array('tgl_kendala' => $tanggal)); 				  
		}
		
		
		
	}		
<?php
class M_Kendala_Harian extends CI_Model {
    
	var $tb = "kendala_harian";
	var $id = "id_kendala_harian";
	
	function __construct()
	{
		parent::__construct();	
	}
    
	function post($data) // input data
	{
		$this->db->insert($this->tb,$data);
	}	
	
	function edit($data, $key)
	{
		$this->db->where($this->id, $key);
		$this->db->update($this->tb, $data);
	}
	
	function get_kendala_harian($key, $tgl, $id_petugas_khusus = null) // ambil kendala harian
	{
		$tanggal = $_SESSION['tahun_sess']."-".$_SESSION['bulan_sess']."-".$tgl;
		
		
		if ($id_petugas_khusus == null) {
			$this->db->where("id_petugas", $key);
		} else {
			$this->db->where("id_petugas", $id_petugas_khusus);
		}
		$this->db->where("tgl_kendala", $tanggal);
		return $this->db->get($this->tb);
	}
	
	function hapus($tgl) // hapus data tusbung
	{
		$tanggal = $_SESSION['tahun_sess']."-".$_SESSION['bulan_sess']."-".$tgl;
		$this->db->delete($this->tb, array('tgl_kendala' => $tanggal)); 				  
	}
}	
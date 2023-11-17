<?php
class M_Tusbung_Harian extends CI_Model {
    
	var $tb = " tusbung_harian";
	var $id = "id_tusbung_harian";
	
	function __construct()
	{
		parent::__construct();	
	}
    
	
	function cek($id_pelanggan, $tgl_tusbung) // ambil semua data pelanggan per unit 
	{
		return $this->db->get_where($this->tb, array("id_pelanggan" => $id_pelanggan, "tgl_tusbung" => $tgl_tusbung));
	}
	
	
	
	function get_tul_petugas($key, $tgl, $id_petugas_khusus = null) // ambil semua data pelanggan / tul per petugas
	{
		$tanggal = $_SESSION['tahun_sess']."-".$_SESSION['bulan_sess']."-".$tgl;
		$this->db->join('tusbung_kumulatif', 'tusbung_kumulatif.id_pelanggan = tusbung_harian.id_pelanggan');
		
		if ($id_petugas_khusus == null) {
			$this->db->where("tusbung_kumulatif.id_petugas_khusus", null);
			$this->db->where("tusbung_kumulatif.id_petugas", $key);
		} else {
			$this->db->where("tusbung_kumulatif.id_petugas_khusus", $id_petugas_khusus);
		}	
		$this->db->where("bulan", $_SESSION['bulan_sess']);
		$this->db->where("tahun", $_SESSION['tahun_sess']);
		$this->db->where("tgl_tusbung", $tanggal);
		return $this->db->get($this->tb);
	}
	
	
	function get_tul_petugas_rp($key, $tgl, $id_petugas_khusus = null) // ambil semua data pelanggan / tul per petugas
	{
		$tanggal = $_SESSION['tahun_sess']."-".$_SESSION['bulan_sess']."-".$tgl;
		$this->db->select_sum('tusbung_kumulatif.rptag');
		$this->db->join('tusbung_kumulatif', 'tusbung_kumulatif.id_pelanggan = tusbung_harian.id_pelanggan');
		
		if ($id_petugas_khusus == null) {
			$this->db->where("tusbung_kumulatif.id_petugas_khusus", null);
			$this->db->where("tusbung_kumulatif.id_petugas", $key);
		} else {
			$this->db->where("tusbung_kumulatif.id_petugas_khusus", $id_petugas_khusus);
		}
		$this->db->where("bulan", $_SESSION['bulan_sess']);
		$this->db->where("tahun", $_SESSION['tahun_sess']);
		$this->db->where("tgl_tusbung", $tanggal);
		return $this->db->get($this->tb);
	}
	
	
	function get_lunas_petugas($key, $tgl, $id_petugas_khusus = null) // ambil semua data pelanggan lunas
	{
		$tanggal = $_SESSION['tahun_sess']."-".$_SESSION['bulan_sess']."-".$tgl;
		$this->db->join('tusbung_kumulatif', 'tusbung_kumulatif.id_pelanggan = tusbung_harian.id_pelanggan');
		if ($id_petugas_khusus == null) {
			$this->db->where("tusbung_kumulatif.id_petugas_khusus", null);
			$this->db->where("tusbung_kumulatif.id_petugas", $key);
		} else {
			$this->db->where("tusbung_kumulatif.id_petugas_khusus", $id_petugas_khusus);
		}
		$this->db->where("bulan", $_SESSION['bulan_sess']);
		$this->db->where("tahun", $_SESSION['tahun_sess']);
		$this->db->where("tgl_tusbung", $tanggal);
		$this->db->where("tusbung_kumulatif.is_lunas", 1);
		return $this->db->get($this->tb);
	}
	
	
	function get_lunas_petugas_rp($key, $tgl, $id_petugas_khusus = null) // ambil semua data pelanggan lunas rp
	{
		$tanggal = $_SESSION['tahun_sess']."-".$_SESSION['bulan_sess']."-".$tgl;
		$this->db->select_sum('tusbung_kumulatif.rptag');
		$this->db->join('tusbung_kumulatif', 'tusbung_kumulatif.id_pelanggan = tusbung_harian.id_pelanggan');
		if ($id_petugas_khusus == null) {
			$this->db->where("tusbung_kumulatif.id_petugas_khusus", null);
		$this->db->where("tusbung_kumulatif.id_petugas", $key);
		} else {
			$this->db->where("tusbung_kumulatif.id_petugas_khusus", $id_petugas_khusus);
		}
		$this->db->where("bulan", $_SESSION['bulan_sess']);
		$this->db->where("tahun", $_SESSION['tahun_sess']);
		$this->db->where("tgl_tusbung", $tanggal);
		$this->db->where("tusbung_kumulatif.is_lunas", 1);
		return $this->db->get($this->tb);
	}
	
	function get_evidence($key, $tgl, $id_petugas_khusus = null) // ambil evidence
	{
		$tanggal = $_SESSION['tahun_sess']."-".$_SESSION['bulan_sess']."-".$tgl;
		$this->db->join('tusbung_kumulatif', 'tusbung_kumulatif.id_pelanggan = tusbung_harian.id_pelanggan');
		
		if ($id_petugas_khusus == null) {
			$this->db->where("tusbung_kumulatif.id_petugas_khusus", null);
			$this->db->where("tusbung_kumulatif.id_petugas", $key);
		} else {
			$this->db->where("tusbung_kumulatif.id_petugas_khusus", $id_petugas_khusus);
		}
		$this->db->where("bulan", $_SESSION['bulan_sess']);
		$this->db->where("tahun", $_SESSION['tahun_sess']);
		$this->db->where("tgl_tusbung", $tanggal);
		$this->db->where("is_evidence", 1);
		return $this->db->get($this->tb);
	}
	
	function get_kendala_harian($key, $tgl, $id_petugas_khusus = null) // ambil kendala harian
	{
		$tanggal = $_SESSION['tahun_sess']."-".$_SESSION['bulan_sess']."-".$tgl;
		$this->db->join('tusbung_kumulatif', 'tusbung_kumulatif.id_pelanggan = tusbung_harian.id_pelanggan');
		$this->db->join('kendala_harian', 'kendala_harian.id_petugas = tusbung_kumulatif.id_petugas');
		if ($id_petugas_khusus == null) {
			$this->db->where("tusbung_kumulatif.id_petugas_khusus", null);
			$this->db->where("tusbung_kumulatif.id_petugas", $key);
		} else {
			$this->db->where("tusbung_kumulatif.id_petugas_khusus", $id_petugas_khusus);
		}
		$this->db->where("bulan", $_SESSION['bulan_sess']);
		$this->db->where("tahun", $_SESSION['tahun_sess']);
		$this->db->where("tgl_kendala", $tanggal);
		return $this->db->get($this->tb);
	}
	
	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data  
	function insert_multiple($data)
	{    
		$this->db->insert_batch($this->tb, $data);  
	}
	
	
	
	
	function hapus($key, $tgl) // hapus data tusbung
	{
		$this->db->query("DELETE ".$this->tb." FROM ".$this->tb." 
						  JOIN tusbung_kumulatif ON tusbung_kumulatif.id_pelanggan = tusbung_harian.id_pelanggan 
						  JOIN pelanggan ON pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan
						  WHERE pelanggan.id_unit = '$key' 
						  AND tgl_tusbung = '".$_SESSION['tahun_sess']."-".$_SESSION['bulan_sess']."-".$tgl."' ");
	}
}		
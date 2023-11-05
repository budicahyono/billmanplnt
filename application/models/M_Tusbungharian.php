<?php
class M_Tusbungharian extends CI_Model {
    
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
	
	
	
	function get_tul_petugas($key, $tgl) // ambil semua data pelanggan / tul per petugas
	{
		$this->db->join('tusbung_kumulatif', 'tusbung_kumulatif.id_pelanggan = tusbung_harian.id_pelanggan');
		return $this->db->get_where($this->tb, array( "tusbung_kumulatif.id_petugas" => $key, "tgl_tusbung" => $_SESSION['tahun_sess']."-".$_SESSION['bulan_sess']."-".$tgl));
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
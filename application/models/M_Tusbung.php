<?php
class M_Tusbung extends CI_Model {
    
	var $tb = "tusbung_kumulatif";
	var $id = "id_tusbung_kumulatif";
	
	function __construct()
	{
		parent::__construct();	
	}
    
	
	function get_by_unit($key) // ambil semua data pelanggan per unit 
	{
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		return $this->db->get_where($this->tb, array("pelanggan.id_unit" => $key, "bulan" => $_SESSION['bulan_sess'], "tahun" => $_SESSION['tahun_sess'] ));
	}
	
    function get_lunas($key) // ambil semua data pelanggan lunas 
	{
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		return $this->db->get_where($this->tb, array("pelanggan.id_unit" => $key, "is_lunas" => 1, "bulan" => $_SESSION['bulan_sess'], "tahun" => $_SESSION['tahun_sess'] ));
	}
	
	function get_blm($key) // ambil semua data pelanggan blm lunas 
	{
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		return $this->db->get_where($this->tb, array("pelanggan.id_unit" => $key, "is_lunas" => 0, "bulan" => $_SESSION['bulan_sess'], "tahun" => $_SESSION['tahun_sess'] ));
	}
	
	function get_blm_rp($key) // ambil semua data pelanggan blm lunas dan hitung rupiahnya
	{
		$this->db->select_sum('tusbung_kumulatif.rptag');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		return $this->db->get_where($this->tb, array("pelanggan.id_unit" => $key, "is_lunas" => 0, "bulan" => $_SESSION['bulan_sess'], "tahun" => $_SESSION['tahun_sess']));
	}
	
	function get_lunas_rp($key) // ambil semua data pelanggan lunas dan hitung rupiahnya
	{
		$this->db->select_sum('tusbung_kumulatif.rptag');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		return $this->db->get_where($this->tb, array("pelanggan.id_unit" => $key, "is_lunas" => 1, "bulan" => $_SESSION['bulan_sess'], "tahun" => $_SESSION['tahun_sess']));
	}
	
	function get_unit_rp($key) // ambil semua data pelanggan dan hitung rupiahnya
	{
		$this->db->select_sum('tusbung_kumulatif.rptag');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		return $this->db->get_where($this->tb, array("pelanggan.id_unit" => $key, "bulan" => $_SESSION['bulan_sess'], "tahun" => $_SESSION['tahun_sess']));
	}
	
	
	function cek($where){	//cek di tusbung apakah sudah ada id_pelanggan, bulan dan tahun tersebut 
		return $this->db->get_where($this->tb,$where);
	}
	
	
	
	
	function get_tul_petugas($key, $id_unit) // ambil semua data pelanggan / tul per petugas
	{
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		return $this->db->get_where($this->tb, array("pelanggan.id_unit" => $id_unit, "id_petugas" => $key, "bulan" => $_SESSION['bulan_sess'], "tahun" => $_SESSION['tahun_sess'] ));
	}
	
	function get_tul_petugas_rp($key, $id_unit) // ambil semua data pelanggan / tul per petugas dan hitung rupiahnya
	{
		$this->db->select_sum('tusbung_kumulatif.rptag');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		return $this->db->get_where($this->tb, array("pelanggan.id_unit" => $id_unit, "id_petugas" => $key, "bulan" => $_SESSION['bulan_sess'], "tahun" => $_SESSION['tahun_sess']));
	}
	
	function get_tul_lunas($key, $id_unit) // ambil semua data pelanggan / tul per petugas yg lunas
	{
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		return $this->db->get_where($this->tb, array("pelanggan.id_unit" => $id_unit, "id_petugas" => $key, "bulan" => $_SESSION['bulan_sess'], "tahun" => $_SESSION['tahun_sess'], "is_lunas" => 1));
	}
	
	function get_tul_lunas_rp($key, $id_unit) // ambil semua data pelanggan / tul per petugas yg lunas dan hitung rupiahnya
	{
		$this->db->select_sum('tusbung_kumulatif.rptag');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		return $this->db->get_where($this->tb, array("pelanggan.id_unit" => $id_unit, "id_petugas" => $key, "bulan" => $_SESSION['bulan_sess'], "tahun" => $_SESSION['tahun_sess'], "is_lunas" => 1));
	}
	
	function get_tul_blm($key, $id_unit) // ambil semua data pelanggan / tul per petugas yg belum
	{
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		return $this->db->get_where($this->tb, array("pelanggan.id_unit" => $id_unit, "id_petugas" => $key, "bulan" => $_SESSION['bulan_sess'], "tahun" => $_SESSION['tahun_sess'], "is_lunas" => 0));
	}
	
	function get_tul_blm_rp($key, $id_unit) // ambil semua data pelanggan / tul per petugas yg belum dan hitung rupiahnya
	{
		$this->db->select_sum('tusbung_kumulatif.rptag');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		return $this->db->get_where($this->tb, array("pelanggan.id_unit" => $id_unit, "id_petugas" => $key, "bulan" => $_SESSION['bulan_sess'], "tahun" => $_SESSION['tahun_sess'], "is_lunas" => 0));
	}
	
	function get_baca_blm($key, $baca) // ambil data tul per petugas dan kode baca yg belum
	{
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		$this->db->where("id_petugas", $key);
		$this->db->where("SUBSTRING(kddk, 7, 1) = '$baca'");
		$this->db->where("bulan", $_SESSION['bulan_sess']);
		$this->db->where("tahun", $_SESSION['tahun_sess']);
		$this->db->where("is_lunas", 0);
		return $this->db->get($this->tb);
	
	}
	
	
	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data  
	function insert_multiple($data)
	{    
		$this->db->insert_batch($this->tb, $data);  
	}
	
	function edit($data, $key)
	{
		$this->db->where($this->id, $key);
		$this->db->update($this->tb, $data);
	}
	
}		
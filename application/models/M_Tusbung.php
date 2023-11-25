<?php
class M_Tusbung extends CI_Model {
    
	var $tb = "tusbung_kumulatif";
	var $id = "id_tusbung_kumulatif";
	
	function __construct()
	{
		parent::__construct();	
	}
    
	
	function get_by_idpel($key) // ambil semua data pelanggan per idpelanggan
	{
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		$this->db->join('petugas', 'petugas.id_petugas = tusbung_kumulatif.id_petugas');
		$this->db->join('jenis_kendala', 'jenis_kendala.id_jenis_kendala = tusbung_kumulatif.id_jenis_kendala');
		$this->db->where("pelanggan.id_pelanggan", $key);
		return $this->db->get($this->tb);
	}
	
	function get_by_tgl($key, $tgl, $limit = null, $q = null) // ambil semua data pelanggan per unit 
	{
		$tanggal = $_SESSION['tahun_sess']."-".$_SESSION['bulan_sess']."-".$tgl;
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		$this->db->join('jenis_kendala', 'jenis_kendala.id_jenis_kendala = tusbung_kumulatif.id_jenis_kendala');
		if ($limit != null) {
			$this->db->limit($limit);
		}
		if ($q != null ) {
			$this->db->where("(tusbung_kumulatif.id_pelanggan LIKE '%".$q."%' OR pelanggan.nama_pelanggan LIKE '%".$q."%')");
		}
		$this->db->where("pelanggan.id_unit", $key);
		$this->db->where("tgl_lunas", $tanggal);
		return $this->db->get($this->tb);
	}
	
	function get_by_tgl_petugas($key, $id_unit, $tgl, $limit = null, $q = null) // ambil semua data pelanggan per unit 
	{
		$tanggal = $_SESSION['tahun_sess']."-".$_SESSION['bulan_sess']."-".$tgl;
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		$this->db->join('jenis_kendala', 'jenis_kendala.id_jenis_kendala = tusbung_kumulatif.id_jenis_kendala');
		if ($limit != null) {
			$this->db->limit($limit);
		}
		if ($q != null ) {
			$this->db->where("(tusbung_kumulatif.id_pelanggan LIKE '%".$q."%' OR pelanggan.nama_pelanggan LIKE '%".$q."%')");
		}
		$this->db->where("pelanggan.id_unit", $id_unit);
		$this->db->where("id_petugas", $key);
		$this->db->where("tgl_lunas", $tanggal);
		return $this->db->get($this->tb);
	}
	
	function get_by_unit($key, $limit = null, $q = null) // ambil semua data pelanggan per unit 
	{
		
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		$this->db->join('jenis_kendala', 'jenis_kendala.id_jenis_kendala = tusbung_kumulatif.id_jenis_kendala');
		if ($limit != null) {
			$this->db->limit($limit);
		}
		if ($q != null ) {
			$this->db->where("(tusbung_kumulatif.id_pelanggan LIKE '%".$q."%' OR pelanggan.nama_pelanggan LIKE '%".$q."%')");
		}
		$this->db->where("pelanggan.id_unit", $key);
		$this->db->where("bulan", $_SESSION['bulan_sess']);
		$this->db->where("tahun", $_SESSION['tahun_sess']);
		return $this->db->get($this->tb);
	}
	
	
    function get_lunas($key, $limit = null, $q = null) // ambil semua data pelanggan lunas 
	{
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		$this->db->join('jenis_kendala', 'jenis_kendala.id_jenis_kendala = tusbung_kumulatif.id_jenis_kendala');
		if ($limit != null) {
			$this->db->limit($limit);
		}
		if ($q != null ) {
			$this->db->where("(tusbung_kumulatif.id_pelanggan LIKE '%".$q."%' OR pelanggan.nama_pelanggan LIKE '%".$q."%')");
		}
		$this->db->where("pelanggan.id_unit", $key);
		$this->db->where("bulan", $_SESSION['bulan_sess']);
		$this->db->where("tahun", $_SESSION['tahun_sess']);
		$this->db->where("is_lunas", 1);
		return $this->db->get($this->tb);
	}
	
	function get_blm($key, $limit = null, $q = null) // ambil semua data pelanggan blm lunas 
	{
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		$this->db->join('jenis_kendala', 'jenis_kendala.id_jenis_kendala = tusbung_kumulatif.id_jenis_kendala');
		if ($limit != null) {
			$this->db->limit($limit);
		}
		if ($q != null ) {
			$this->db->where("(tusbung_kumulatif.id_pelanggan LIKE '%".$q."%' OR pelanggan.nama_pelanggan LIKE '%".$q."%')");
		}
		$this->db->where("pelanggan.id_unit", $key);
		$this->db->where("bulan", $_SESSION['bulan_sess']);
		$this->db->where("tahun", $_SESSION['tahun_sess']);
		$this->db->where("is_lunas", 0);
		return $this->db->get($this->tb);
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
	
	
	
	
	function get_tul_petugas($key, $id_unit, $limit = null, $q = null) // ambil semua data pelanggan / tul per petugas
	{
		
		
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		$this->db->join('jenis_kendala', 'jenis_kendala.id_jenis_kendala = tusbung_kumulatif.id_jenis_kendala');
		if ($limit != null) {
			$this->db->limit($limit);
		}
		if ($q != null ) {
			$this->db->where("(tusbung_kumulatif.id_pelanggan LIKE '%".$q."%' OR pelanggan.nama_pelanggan LIKE '%".$q."%')");
		}
		$this->db->where("pelanggan.id_unit", $id_unit);
		$this->db->where("id_petugas", $key);
		$this->db->where("bulan", $_SESSION['bulan_sess']);
		$this->db->where("tahun", $_SESSION['tahun_sess']);
		return $this->db->get($this->tb);
	}
	
	function get_tul_petugas_rp($key, $id_unit) // ambil semua data pelanggan / tul per petugas dan hitung rupiahnya
	{
		$this->db->select_sum('tusbung_kumulatif.rptag');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		return $this->db->get_where($this->tb, array("pelanggan.id_unit" => $id_unit, "id_petugas" => $key, "bulan" => $_SESSION['bulan_sess'], "tahun" => $_SESSION['tahun_sess']));
	}
	
	function get_tul_lunas($key, $id_unit, $limit = null, $q = null) // ambil semua data pelanggan / tul per petugas yg lunas
	{
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		$this->db->join('jenis_kendala', 'jenis_kendala.id_jenis_kendala = tusbung_kumulatif.id_jenis_kendala');
		if ($limit != null) {
			$this->db->limit($limit);
		}
		if ($q != null ) {
			$this->db->where("(tusbung_kumulatif.id_pelanggan LIKE '%".$q."%' OR pelanggan.nama_pelanggan LIKE '%".$q."%')");
		}
		$this->db->where("pelanggan.id_unit", $id_unit);
		$this->db->where("id_petugas", $key);
		$this->db->where("bulan", $_SESSION['bulan_sess']);
		$this->db->where("tahun", $_SESSION['tahun_sess']);
		$this->db->where("is_lunas", 1);
		return $this->db->get($this->tb);
	}
	
	function get_tul_lunas_rp($key, $id_unit) // ambil semua data pelanggan / tul per petugas yg lunas dan hitung rupiahnya
	{
		$this->db->select_sum('tusbung_kumulatif.rptag');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		return $this->db->get_where($this->tb, array("pelanggan.id_unit" => $id_unit, "id_petugas" => $key, "bulan" => $_SESSION['bulan_sess'], "tahun" => $_SESSION['tahun_sess'], "is_lunas" => 1));
	}
	
	function get_tul_blm($key, $id_unit, $limit = null, $q = null) // ambil semua data pelanggan / tul per petugas yg belum
	{
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		$this->db->join('jenis_kendala', 'jenis_kendala.id_jenis_kendala = tusbung_kumulatif.id_jenis_kendala');
		if ($limit != null) {
			$this->db->limit($limit);
		}
		if ($q != null ) {
			$this->db->where("(tusbung_kumulatif.id_pelanggan LIKE '%".$q."%' OR pelanggan.nama_pelanggan LIKE '%".$q."%')");
		}
		$this->db->where("pelanggan.id_unit", $id_unit);
		$this->db->where("id_petugas", $key);
		$this->db->where("bulan", $_SESSION['bulan_sess']);
		$this->db->where("tahun", $_SESSION['tahun_sess']);
		$this->db->where("is_lunas", 0);
		return $this->db->get($this->tb);
	}
	
	function get_tul_blm_rp($key, $id_unit) // ambil semua data pelanggan / tul per petugas yg belum dan hitung rupiahnya
	{
		$this->db->select_sum('tusbung_kumulatif.rptag');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		return $this->db->get_where($this->tb, array("pelanggan.id_unit" => $id_unit, "id_petugas" => $key, "bulan" => $_SESSION['bulan_sess'], "tahun" => $_SESSION['tahun_sess'], "is_lunas" => 0));
	}
	
	function get_baca_blm($key, $baca, $id_unit) // ambil data tul per petugas dan kode baca yg belum
	{
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		$this->db->where("id_petugas", $key);
		$this->db->where("pelanggan.id_unit", $id_unit);
		$this->db->where("SUBSTRING(kddk, 7, 1) = '$baca'");
		$this->db->where("bulan", $_SESSION['bulan_sess']);
		$this->db->where("tahun", $_SESSION['tahun_sess']);
		$this->db->where("is_lunas", 0);
		return $this->db->get($this->tb);
	
	}
	
	function get_baca_blm_rp($key, $baca, $id_unit) // ambil data tul per petugas dan kode baca yg belum dan hitung rupiahnya
	{
		$this->db->select_sum('tusbung_kumulatif.rptag');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		$this->db->where("id_petugas", $key);
		$this->db->where("pelanggan.id_unit", $id_unit);
		$this->db->where("SUBSTRING(kddk, 7, 1) = '$baca'");
		$this->db->where("bulan", $_SESSION['bulan_sess']);
		$this->db->where("tahun", $_SESSION['tahun_sess']);
		$this->db->where("is_lunas", 0);
		return $this->db->get($this->tb);
	
	}
	
	function get_by_jenis_kendala($key, $id_unit) // ambil data tul / pelanggan per jenis kendala yg blm lunas
	{
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		$this->db->where("id_jenis_kendala", $key);
		$this->db->where("pelanggan.id_unit", $id_unit);
		$this->db->where("bulan", $_SESSION['bulan_sess']);
		$this->db->where("tahun", $_SESSION['tahun_sess']);
		$this->db->where("is_lunas", 0);
		return $this->db->get($this->tb);
	
	}
	
	function get_by_jenis_kendala_rp($key, $id_unit) // ambil data tul / pelanggan per jenis kendala yg blm lunas dan hitung rupiahnya
	{
		$this->db->select_sum('tusbung_kumulatif.rptag');
		$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
		$this->db->where("id_jenis_kendala", $key);
		$this->db->where("pelanggan.id_unit", $id_unit);
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
	
	function edit_lunas($data, $key, $bulan, $tahun)
	{
		$this->db->where("id_pelanggan", $key);
		$this->db->where("bulan", $bulan);
		$this->db->where("tahun", $tahun);
		$this->db->update($this->tb, $data);
	}
	
	function edit_petugas_khusus($data, $key, $bulan, $tahun)
	{
		$this->db->where("id_pelanggan", $key);
		$this->db->where("bulan", $bulan);
		$this->db->where("tahun", $tahun);
		$this->db->update($this->tb, $data);
	}
	
	
	function hapus($key) // hapus data tusbung
	{
		$this->db->query("DELETE ".$this->tb." FROM ".$this->tb." 
						  JOIN pelanggan ON pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan 
						  WHERE pelanggan.id_unit = '$key' 
						  AND bulan = '".$_SESSION['bulan_sess']."' 
						  AND tahun = '".$_SESSION['tahun_sess']."' ");
	}
}		
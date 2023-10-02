<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_kendala extends CI_Controller {
	function __construct(){
				parent::__construct();
						
				$this->load->model('M_Admin');
				if (!$this->M_Admin->is_login()) { // jika belum login (tanda ! didepan) maka dilempar ke halaman awal
					redirect(".");		
				} 
				function tgl_indo($date)
				{
					$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
					$tahun = substr($date, 0, 4);
					$bulan = substr($date, 5, 2);
					$tgl   = substr($date, 8, 2);
					$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;		
					return $result;
				}
				
				
				 
		}
		
	public function index()
	{
		$data = array(
			'app' => 'Billman PLN-T',
			'title' => "Jenis Kendala",
			'menu' => ucfirst($this->uri->segment(1)),
		);
		$this->template->load('template','jenis_kendala/v_index',$data);
	}
	
	public function profil()
	{
		$data = array(
			'app' => 'Billman PLN-T',
			'title' => ucfirst($this->uri->segment(1)),
		);
		$this->template->load('template','v_profil',$data);
	}
	
	
}

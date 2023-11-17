<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	function __construct(){
			parent::__construct();
					
			$this->load->model('M_Admin');
			$this->load->model('M_Unit');
			$this->load->model('M_Tusbung');
			$this->load->model('M_Pelanggan');
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
			
			function bln_indo($date)
			{
				$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
			 
				
				$bulan = $date;
				 
			 
				$result =   $BulanIndo[(int)$bulan-1] ;		
				return($result);
			}
			
			 
	}
	
		
	public function index()
	{
		//inisiasi id unit berdasarkan nama unit
		$id_bintuni = 2 ; 
		$id_manokwari = 1 ; 
		$id_wasior = 3 ; 
		$id_prafi = 4 ; 
		
		
		//lunas by rupiah
		
		//bintuni
		$cek_total_bintuni_rp = $this->M_Tusbung->get_unit_rp($id_bintuni);
		foreach ($cek_total_bintuni_rp->result() as $r) {
			$total_bintuni_rp = $r->rptag;
		 }
		$cek_lunas_bintuni_rp = $this->M_Tusbung->get_lunas_rp($id_bintuni);
		 foreach ($cek_lunas_bintuni_rp->result() as $r) {
			$lunas_bintuni_rp = $r->rptag;
		 }
		 $cek_blm_bintuni_rp = $this->M_Tusbung->get_blm_rp($id_bintuni);
		 foreach ($cek_blm_bintuni_rp->result() as $r) {
			$blm_bintuni_rp = $r->rptag;
		 }
		 
		 if ($total_bintuni_rp != 0 && $lunas_bintuni_rp != 0) {
			$persen_bintuni_rp = round($lunas_bintuni_rp / $total_bintuni_rp * 100, 1);
		} else {
			$persen_bintuni_rp = 0;
		}
		
		//manokwari
		$cek_total_manokwari_rp = $this->M_Tusbung->get_unit_rp($id_manokwari);
		foreach ($cek_total_manokwari_rp->result() as $r) {
			$total_manokwari_rp = $r->rptag;
		 }
		$cek_lunas_manokwari_rp = $this->M_Tusbung->get_lunas_rp($id_manokwari);
		 foreach ($cek_lunas_manokwari_rp->result() as $r) {
			$lunas_manokwari_rp = $r->rptag;
		 }
		  $cek_blm_manokwari_rp = $this->M_Tusbung->get_blm_rp($id_manokwari);
		 foreach ($cek_blm_manokwari_rp->result() as $r) {
			$blm_manokwari_rp = $r->rptag;
		 }
		 if ($total_manokwari_rp != 0 && $lunas_manokwari_rp != 0) {
			$persen_manokwari_rp = round($lunas_manokwari_rp / $total_manokwari_rp * 100, 1);
		} else {
			$persen_manokwari_rp = 0;
		}
		
		//wasior
		$cek_total_wasior_rp = $this->M_Tusbung->get_unit_rp($id_wasior);
		foreach ($cek_total_wasior_rp->result() as $r) {
			$total_wasior_rp = $r->rptag;
		 }
		$cek_lunas_wasior_rp = $this->M_Tusbung->get_lunas_rp($id_wasior);
		 foreach ($cek_lunas_wasior_rp->result() as $r) {
			$lunas_wasior_rp = $r->rptag;
		 }
		  $cek_blm_wasior_rp = $this->M_Tusbung->get_blm_rp($id_wasior);
		 foreach ($cek_blm_wasior_rp->result() as $r) {
			$blm_wasior_rp = $r->rptag;
		 }
		 if ($total_wasior_rp != 0 && $lunas_wasior_rp != 0) {
			$persen_wasior_rp = round($lunas_wasior_rp / $total_wasior_rp * 100, 1);
		} else {
			$persen_wasior_rp = 0;
		}
		
		//prafi
		$cek_total_prafi_rp = $this->M_Tusbung->get_unit_rp($id_prafi);
		foreach ($cek_total_prafi_rp->result() as $r) {
			$total_prafi_rp = $r->rptag;
		 }
		$cek_lunas_prafi_rp = $this->M_Tusbung->get_lunas_rp($id_prafi);
		 foreach ($cek_lunas_prafi_rp->result() as $r) {
			$lunas_prafi_rp = $r->rptag;
		 }
		  $cek_blm_prafi_rp = $this->M_Tusbung->get_blm_rp($id_prafi);
		 foreach ($cek_blm_prafi_rp->result() as $r) {
			$blm_prafi_rp = $r->rptag;
		 }
		 if ($total_prafi_rp != 0 && $lunas_prafi_rp != 0) {
			$persen_prafi_rp = round($lunas_prafi_rp / $total_prafi_rp * 100, 1);
		} else {
			$persen_prafi_rp = 0;
		}
		
		//UP3 
		$total_up3_rp = $total_prafi_rp+$total_wasior_rp+$total_manokwari_rp+$total_bintuni_rp;
		$lunas_up3_rp = $lunas_prafi_rp+$lunas_wasior_rp+$lunas_manokwari_rp+$lunas_bintuni_rp;
		$blm_up3_rp = $blm_prafi_rp+$blm_wasior_rp+$blm_manokwari_rp+$blm_bintuni_rp;
		if ($total_up3_rp != 0 && $lunas_up3_rp != 0) {
			$persen_up3_rp = round($lunas_up3_rp / $total_up3_rp * 100, 1);
			} else {
			$persen_up3_rp = 0;
		}
		
		
		
		
		
			
		//lunas by pelanggan
		
		//bintuni
		$total_bintuni = $this->M_Tusbung->get_by_unit($id_bintuni)->num_rows();
		$lunas_bintuni = $this->M_Tusbung->get_lunas($id_bintuni)->num_rows();
		$blm_bintuni = $this->M_Tusbung->get_blm($id_bintuni)->num_rows();
	 
		if ($total_bintuni != 0 && $lunas_bintuni != 0) {
			$persen_bintuni = round($lunas_bintuni / $total_bintuni * 100, 1);
		} else {
			$persen_bintuni = 0;
		}
		
		
		
		//manokwari
		$total_manokwari = $this->M_Tusbung->get_by_unit($id_manokwari)->num_rows();
		$lunas_manokwari = $this->M_Tusbung->get_lunas($id_manokwari)->num_rows();
		$blm_manokwari = $this->M_Tusbung->get_blm($id_manokwari)->num_rows();
	 
		if ($total_manokwari != 0 && $lunas_manokwari != 0) {
			$persen_manokwari = round($lunas_manokwari / $total_manokwari * 100, 1);
		} else {
			$persen_manokwari = 0;
		}
		
		//wasior
		$total_wasior = $this->M_Tusbung->get_by_unit($id_wasior)->num_rows();
		$lunas_wasior = $this->M_Tusbung->get_lunas($id_wasior)->num_rows();
		$blm_wasior = $this->M_Tusbung->get_blm($id_wasior)->num_rows();
	 
		if ($total_wasior != 0 && $lunas_wasior != 0) {
			$persen_wasior = round($lunas_wasior / $total_wasior * 100, 1);
		} else {
			$persen_wasior = 0;
		}
		
		//prafi
		$total_prafi = $this->M_Tusbung->get_by_unit($id_prafi)->num_rows();
		$lunas_prafi = $this->M_Tusbung->get_lunas($id_prafi)->num_rows();
		$blm_prafi = $this->M_Tusbung->get_blm($id_prafi)->num_rows();
	 
		if ($total_prafi != 0 && $lunas_prafi != 0) {
			$persen_prafi = round($lunas_prafi / $total_prafi * 100, 1);
		} else {
			$persen_prafi = 0;
		}
		
		//UP3 
		$total_up3 = $total_prafi+$total_wasior+$total_manokwari+$total_bintuni;
		$lunas_up3 = $lunas_prafi+$lunas_wasior+$lunas_manokwari+$lunas_bintuni;
		$blm_up3   = $blm_prafi+$blm_wasior+$blm_manokwari+$blm_bintuni;
		if ($total_up3 != 0 && $lunas_up3 != 0) {
			$persen_up3 = round($lunas_up3 / $total_up3 * 100, 1);
		} else {
			$persen_up3 = 0;
		}
		
		$data = array(
			'app' => 'Billman SAYA',
			'title' => ucfirst($this->uri->segment(1)),
			'total_bintuni'	=>	$total_bintuni,
			'total_manokwari'	=>	$total_manokwari,
			'total_wasior'		=>	$total_wasior,
			'total_prafi'		=>	$total_prafi,
			'total_up3'			=>	$total_up3,
			
			'lunas_bintuni'		=>	$lunas_bintuni,
			'lunas_manokwari'	=>	$lunas_manokwari,
			'lunas_wasior'		=>	$lunas_wasior,
			'lunas_prafi'		=>	$lunas_prafi,
			'lunas_up3'			=>	$lunas_up3,
			
			'blm_bintuni'		=>	$blm_bintuni,
			'blm_manokwari'		=>	$blm_manokwari,
			'blm_wasior'		=>	$blm_wasior,
			'blm_prafi'			=>	$blm_prafi,
			'blm_up3'			=>	$blm_up3,
			
			'blm_bintuni_rp'		=>	$blm_bintuni_rp,
			'blm_manokwari_rp'		=>	$blm_manokwari_rp,
			'blm_wasior_rp'			=>	$blm_wasior_rp,
			'blm_prafi_rp'			=>	$blm_prafi_rp,
			'blm_up3_rp'			=>	$blm_up3_rp,
			
			'total_bintuni_rp'		=>	$total_bintuni_rp,
			'total_manokwari_rp'	=>	$total_manokwari_rp,
			'total_wasior_rp'		=>	$total_wasior_rp,
			'total_prafi_rp'		=>	$total_prafi_rp,
			'total_up3_rp'			=>	$total_up3_rp,
			
			'lunas_bintuni_rp'		=>	$lunas_bintuni_rp,
			'lunas_manokwari_rp'	=>	$lunas_manokwari_rp,
			'lunas_wasior_rp'		=>	$lunas_wasior_rp,
			'lunas_prafi_rp'		=>	$lunas_prafi_rp,
			'lunas_up3_rp'			=>	$lunas_up3_rp,
			
			'persen_bintuni'	=>	$persen_bintuni,
			'persen_manokwari'	=>	$persen_manokwari,
			'persen_wasior'		=>	$persen_wasior,
			'persen_prafi'		=>	$persen_prafi,
			'persen_up3'		=>	$persen_up3,
			
			'persen_bintuni_rp'		=>	$persen_bintuni_rp,
			'persen_manokwari_rp'	=>	$persen_manokwari_rp,
			'persen_wasior_rp'		=>	$persen_wasior_rp,
			'persen_prafi_rp'		=>	$persen_prafi_rp,
			'persen_up3_rp'			=>	$persen_up3_rp,
		);
		$this->template->load('template','v_dashboard',$data);
	}
	
	public function home()
	{
		$data = array(
			'app' => 'Billman SAYA',
			'title' => 'Dashboard',
		);
		$this->template->load('template','admin/v_index',$data);
	}
}

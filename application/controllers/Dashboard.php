<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	function __construct(){
			parent::__construct();
					
			$this->load->model('M_Admin');
			$this->load->model('M_Unit');
			$this->load->model('M_Tusbung');
			$this->load->model('M_Pelanggan');
			is_login("yes");
			
			
			
			 
	}
	
		
	public function index()
	{
		//inisiasi id unit berdasarkan nama unit
		$id_bintuni = 2 ; 
		$id_manokwari = 1 ; 
		$id_wasior = 3 ; 
		$id_prafi = 4 ; 
		
		
		//lunas by rupiah
		$op = 'rp';
		//bintuni
		$total_bintuni_rp 	= $this->M_Tusbung->get_tul(['id_unit' => $id_bintuni,'opsi' => $op,'jenis' => 'tul']);
		$lunas_bintuni_rp 	= $this->M_Tusbung->get_tul(['id_unit' => $id_bintuni,'opsi' => $op,'jenis' => 'lunas']);
		$blm_bintuni_rp 	= $this->M_Tusbung->get_tul(['id_unit' => $id_bintuni,'opsi' => $op,'jenis' => 'blm']);
		
		 
		if ($total_bintuni_rp != 0 && $lunas_bintuni_rp != 0) {
			$persen_bintuni_rp = round($lunas_bintuni_rp / $total_bintuni_rp * 100, 1);
		} else {
			$persen_bintuni_rp = 0;
		}
		
		//manokwari
		
		$total_manokwari_rp = $this->M_Tusbung->get_tul(['id_unit' => $id_manokwari,'opsi' => $op,'jenis' => 'tul']);
		$lunas_manokwari_rp = $this->M_Tusbung->get_tul(['id_unit' => $id_manokwari,'opsi' => $op,'jenis' => 'lunas']);
		$blm_manokwari_rp 	= $this->M_Tusbung->get_tul(['id_unit' => $id_manokwari,'opsi' => $op,'jenis' => 'blm']);
		
		if ($total_manokwari_rp != 0 && $lunas_manokwari_rp != 0) {
			$persen_manokwari_rp = round($lunas_manokwari_rp / $total_manokwari_rp * 100, 1);
		} else {
			$persen_manokwari_rp = 0;
		}
		
		//wasior
		$total_wasior_rp 	= $this->M_Tusbung->get_tul(['id_unit' => $id_wasior,'opsi' => $op,'jenis' => 'tul']);
		$lunas_wasior_rp 	= $this->M_Tusbung->get_tul(['id_unit' => $id_wasior,'opsi' => $op,'jenis' => 'lunas']);
		$blm_wasior_rp 		= $this->M_Tusbung->get_tul(['id_unit' => $id_wasior,'opsi' => $op,'jenis' => 'blm']);
		
		if ($total_wasior_rp != 0 && $lunas_wasior_rp != 0) {
			$persen_wasior_rp = round($lunas_wasior_rp / $total_wasior_rp * 100, 1);
		} else {
			$persen_wasior_rp = 0;
		}
		
		//prafi
		$total_prafi_rp 	= $this->M_Tusbung->get_tul(['id_unit' => $id_prafi,'opsi' => $op,'jenis' => 'tul']);
		$lunas_prafi_rp 	= $this->M_Tusbung->get_tul(['id_unit' => $id_prafi,'opsi' => $op,'jenis' => 'lunas']);
		$blm_prafi_rp 		= $this->M_Tusbung->get_tul(['id_unit' => $id_prafi,'opsi' => $op,'jenis' => 'blm']);
		
		if ($total_prafi_rp != 0 && $lunas_prafi_rp != 0) {
			$persen_prafi_rp = round($lunas_prafi_rp / $total_prafi_rp * 100, 1);
		} else {
			$persen_prafi_rp = 0;
		}
		
		//UP3 
		$total_up3_rp 	= $total_prafi_rp	+$total_wasior_rp	+$total_manokwari_rp	+$total_bintuni_rp;
		$lunas_up3_rp 	= $lunas_prafi_rp	+$lunas_wasior_rp	+$lunas_manokwari_rp	+$lunas_bintuni_rp;
		$blm_up3_rp 	= $blm_prafi_rp		+$blm_wasior_rp		+$blm_manokwari_rp		+$blm_bintuni_rp;
		if ($total_up3_rp != 0 && $lunas_up3_rp != 0) {
			$persen_up3_rp = round($lunas_up3_rp / $total_up3_rp * 100, 1);
			} else {
			$persen_up3_rp = 0;
		}
		
		
		
		
		
			
		//lunas by pelanggan
		$op = 'sum';
		//bintuni
		$total_bintuni 	= $this->M_Tusbung->get_tul(['id_unit' => $id_bintuni,'opsi' => $op,'jenis' => 'tul'])->num_rows();
		$lunas_bintuni 	= $this->M_Tusbung->get_tul(['id_unit' => $id_bintuni,'opsi' => $op,'jenis' => 'lunas'])->num_rows();
		$blm_bintuni 	= $this->M_Tusbung->get_tul(['id_unit' => $id_bintuni,'opsi' => $op,'jenis' => 'blm'])->num_rows();
	 
		if ($total_bintuni != 0 && $lunas_bintuni != 0) {
			$persen_bintuni = round($lunas_bintuni / $total_bintuni * 100, 1);
		} else {
			$persen_bintuni = 0;
		}
		
		
		
		//manokwari
		$total_manokwari= $this->M_Tusbung->get_tul(['id_unit' => $id_manokwari,'opsi' => $op,'jenis' => 'tul'])->num_rows();
		$lunas_manokwari= $this->M_Tusbung->get_tul(['id_unit' => $id_manokwari,'opsi' => $op,'jenis' => 'lunas'])->num_rows();
		$blm_manokwari	= $this->M_Tusbung->get_tul(['id_unit' => $id_manokwari,'opsi' => $op,'jenis' => 'blm'])->num_rows();
	 
		if ($total_manokwari != 0 && $lunas_manokwari != 0) {
			$persen_manokwari = round($lunas_manokwari / $total_manokwari * 100, 1);
		} else {
			$persen_manokwari = 0;
		}
		
		//wasior
		$total_wasior	= $this->M_Tusbung->get_tul(['id_unit' => $id_wasior,'opsi' => $op,'jenis' => 'tul'])->num_rows();
		$lunas_wasior 	= $this->M_Tusbung->get_tul(['id_unit' => $id_wasior,'opsi' => $op,'jenis' => 'lunas'])->num_rows();
		$blm_wasior   	= $this->M_Tusbung->get_tul(['id_unit' => $id_wasior,'opsi' => $op,'jenis' => 'blm'])->num_rows();
	 
		if ($total_wasior != 0 && $lunas_wasior != 0) {
			$persen_wasior = round($lunas_wasior / $total_wasior * 100, 1);
		} else {
			$persen_wasior = 0;
		}
		
		//prafi
		$total_prafi 	= $this->M_Tusbung->get_tul(['id_unit' => $id_prafi,'opsi' => $op,'jenis' => 'tul'])->num_rows();
		$lunas_prafi 	= $this->M_Tusbung->get_tul(['id_unit' => $id_prafi,'opsi' => $op,'jenis' => 'lunas'])->num_rows();
		$blm_prafi 		= $this->M_Tusbung->get_tul(['id_unit' => $id_prafi,'opsi' => $op,'jenis' => 'blm'])->num_rows();
	 
		if ($total_prafi != 0 && $lunas_prafi != 0) {
			$persen_prafi = round($lunas_prafi / $total_prafi * 100, 1);
		} else {
			$persen_prafi = 0;
		}
		
		//UP3 
		$total_up3 = $total_prafi	+$total_wasior	+$total_manokwari	+$total_bintuni;
		$lunas_up3 = $lunas_prafi	+$lunas_wasior	+$lunas_manokwari	+$lunas_bintuni;
		$blm_up3   = $blm_prafi		+$blm_wasior	+$blm_manokwari		+$blm_bintuni;
		if ($total_up3 != 0 && $lunas_up3 != 0) {
			$persen_up3 = round($lunas_up3 / $total_up3 * 100, 1);
		} else {
			$persen_up3 = 0;
		}
		
		$data = array(
			'total_bintuni'		=>	$total_bintuni,
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
	
	
}

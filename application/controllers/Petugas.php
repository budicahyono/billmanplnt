<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller {
	function __construct(){
				parent::__construct();
						
				$this->load->model('M_Admin');
				$this->load->model('M_Petugas');
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
			'app' 	=> 'Billman PLN-T',
			'title' =>	ucfirst($this->uri->segment(1)),
			'petugas'	=>	$this->M_Petugas->get_all(),
		);
		$this->template->load('template','petugas/v_index',$data);
	}
	
	
	
	public function tambah()
	{
		$data = array(
			'app' 	=> 'Billman PLN-T',
			'title' =>	ucfirst($this->uri->segment(1)),
			'petugas'	=>	$this->M_Petugas->get_all(),
		);
		$this->template->load('template','petugas/v_tambah',$data);
	}
	
	public function post()
	{	
		if(isset($_POST['submit'])){
			$nama_petugas	=  $this->input->post('nama_petugas');
			$data  		=  array('nama_petugas'	=>$nama_petugas,
								 'username'		=>$username,
								 'password'		=>$password,
								 'is_petugas_khusus'		=>$is_petugas_khusus,
								 'id_unit'					=>$id_unit,
								 'last_login'				=>$last_login);
				$this->M_Petugas->post($data);	
				$this->session->set_flashdata('success', "Data petugas <b>Berhasil</b>  disimpan");
				redirect('petugas');
			
		}	
	}
	
	public function edit($id)
	{
		$data = array(
			'app' 	=> 'Billman PLN-T',
			'title' =>	ucfirst($this->uri->segment(1)),
			'petugas'	=>	$this->M_Petugas->get_one($id),
		);
		$this->template->load('template','petugas/v_edit',$data);
	}
	
	public function proses_edit()
	{	
		$data['title'] 	= ucfirst($this->uri->segment(1));
		$data['app'] 	= 'Billman PLN-T';
		if(isset($_POST['submit'])){
			$id_petugas    	=  $this->input->post('id_petugas');
			$nama_petugas	=  $this->input->post('nama_petugas');
			$username		=  $this->input->post('username');
			$password		=  $this->input->post('password');
			$level			=  $this->input->post('level');
			$is_petugas_khusus	=  $this->input->post('is_petugas_khusus');
			$id_unit 			=  $this->input->post('id_unit');
			$last_login 		=  $this->input->post('last_login');
			
			$data       =  array('nama_petugas'	=>$nama_petugas,
								 'username'		=>$username,
								 'password'		=>$password,
								 'level'		=>$level,
								 'is_petugas_khusus'		=>$is_petugas_khusus,
								 'id_unit'					=>$id_unit,
								 'last_login'				=>$last_login);
			$this->M_Petugas->edit($data, $id_petugas);	
			$this->session->set_flashdata('status', "Data petugas <b>Berhasil</b>  diedit");
			redirect('petugas');
		}	
	}
	
	public function hapus($id)
	{
		
		$this->M_Petugas->hapus($id);
		$this->session->set_flashdata('success', "Data petugas <b>Berhasil</b>  dihapus");
		redirect('petugas');
	}
	
	
}

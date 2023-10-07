<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Rp_Kategori extends CI_Controller {
	function __construct(){
				parent::__construct();
						
				$this->load->model('M_Admin');
				$this->load->model('M_Rp_Kategori');
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
			'title' => 'Rp Kategori',
			'rp_kategori'	=>	$this->M_Rp_Kategori->get_all(),
		);
		$this->template->load('template','rp_kategori/v_index',$data);
	}
	
	
	
	public function tambah()
	{
		$data = array(
			'app' 	=> 'Billman PLN-T',
			'title' => 'Rp Kategori',
			'rp_kategori'	=>	$this->M_Rp_Kategori->get_all(),
		);
		$this->template->load('template','rp_kategori/v_tambah',$data);
	}
	
	public function post()
	{	
		if(isset($_POST['submit'])){
			$nama_rp_kategori	=  $this->input->post('nama_rp_kategori');
			$data  		=  array('nama_rp_kategori'=>$nama_rp_kategori);
				$this->M_Rp_Kategori->post($data);	
				$this->session->set_flashdata('success', "Data Rp Kategori <b>Berhasil</b>  disimpan");
				redirect('rp_kategori');
			
		}	
	}
	
	public function edit($id)
	{
		$data = array(
			'app' 	=> 'Billman PLN-T',
			'title' => 'Rp Kategori',
			'rp_kategori'	=>	$this->M_Rp_Kategori->get_one($id),
		);
		$this->template->load('template','rp_kategori/v_edit',$data);
	}
	
	public function proses_edit()
	{	
		$data['title'] 	= 'Rp Kategori';
		$data['app'] 	= 'Billman PLN-T';
		if(isset($_POST['submit'])){
			$id_rp_kategori    =  $this->input->post('id_rp_kategori');
			$nama_rp_kategori	=  $this->input->post('nama_rp_kategori');
			
			$data       =  array('nama_rp_kategori'=>$nama_rp_kategori);
			$this->M_Rp_Kategori->edit($data, $id_rp_kategori);	
			$this->session->set_flashdata('status', "Data Rp Kategori <b>Berhasil</b>  diedit");
			redirect('rp_kategori');
		}	
	}
	
	public function hapus($id)
	{
		
		$this->M_Rp_Kategori->hapus($id);
		$this->session->set_flashdata('success', "Data Rp Kategori <b>Berhasil</b>  dihapus");
		redirect('rp_kategori');
	}
	
}

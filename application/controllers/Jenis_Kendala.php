<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_kendala extends CI_Controller {
	function __construct(){
				parent::__construct();
						
				$this->load->model('M_Admin');
				$this->load->model('M_Jenis_Kendala');
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
			'title' => 'Jenis Kendala',
			'jenis_kendala'	=>	$this->M_Jenis_Kendala->get_all(),
		);
		$this->template->load('template','jenis_kendala/v_index',$data);
	}
	
	
	
	public function tambah()
	{
		$data = array(
			'app' 	=> 'Billman PLN-T',
			'title' => 'Jenis Kendala',
			'jenis_kendala'	=>	$this->M_Jenis_Kendala->get_all(),
		);
		$this->template->load('template','jenis_kendala/v_tambah',$data);
	}
	
	public function post()
	{	
		if(isset($_POST['submit'])){
			$nama_jenis_kendala	=  $this->input->post('nama_jenis_kendala');
			$data  		=  array('nama_jenis_kendala'=>$nama_jenis_kendala);
				$this->M_Jenis_Kendala->post($data);	
				$this->session->set_flashdata('success', "Data Jenis Kendala <b>Berhasil</b>  disimpan");
				redirect('jenis_kendala');
			
		}	
	}
	
	public function edit($id)
	{
		$data = array(
			'app' 	=> 'Billman PLN-T',
			'title' => 'Jenis Kendala',
			'jenis_kendala'	=>	$this->M_Jenis_Kendala->get_one($id),
		);
		$this->template->load('template','jenis_kendala/v_edit',$data);
	}
	
	public function proses_edit()
	{	
		$data['title'] 	= 'Jenis Kendala';
		$data['app'] 	= 'Billman PLN-T';
		if(isset($_POST['submit'])){
			$id_jenis_kendala    =  $this->input->post('id_jenis_kendala');
			$nama_jenis_kendala	=  $this->input->post('nama_jenis_kendala');
			
			$data       =  array('nama_jenis_kendala'=>$nama_jenis_kendala);
			$this->M_Jenis_Kendala->edit($data, $id_jenis_kendala);	
			$this->session->set_flashdata('status', "Data Jenis Kendala <b>Berhasil</b>  diedit");
			redirect('jenis_kendala');
		}	
	}
	
	public function hapus($id)
	{
		
		$this->M_Jenis_Kendala->hapus($id);
		$this->session->set_flashdata('success', "Data Jenis Kendala <b>Berhasil</b>  dihapus");
		redirect('jenis_kendala');
	}
	
	
}

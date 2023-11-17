<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_kendala extends CI_Controller {
	function __construct(){
				parent::__construct();
						
				$this->load->model('M_Admin');
				$this->load->model('M_Jenis_Kendala');
				is_login("yes");
				
		}
		
	public function index()
	{
		$data = array(
			'jenis_kendala'	=>	$this->M_Jenis_Kendala->get_all(),
		);
		$this->template->load('template','jenis_kendala/v_index',$data);
	}
	
	
	
	public function tambah()
	{
		$data = array(
			'jenis_kendala'	=>	$this->M_Jenis_Kendala->get_all(),
		);
		$this->template->load('template','jenis_kendala/v_tambah',$data);
	}
	
	public function post()
	{	
		if(isset($_POST['submit'])){
			$nama_jenis_kendala	=  $this->input->post('nama_jenis_kendala');
			$data  		=  array('nama_jenis_kendala'=> strtoupper($nama_jenis_kendala));
				$jenis_kendala = $this->M_Jenis_Kendala->post($data);	
				$error = $this->db->error();
				if ($error['code'] == null) {
					$this->session->set_flashdata('success', "Data Jenis Kendala <b>Berhasil</b>  disimpan");
				} else {
					$this->session->set_flashdata('error', "Data Jenis Kendala <b>Gagal</b> disimpan. <br>Error:".$error['message']);
				}	
				
				redirect('jenis_kendala');
			
		}	
	}
	
	public function edit($id)
	{
		$jenis_kendala = $this->M_Jenis_Kendala->get_one($id);
		$cek = $jenis_kendala->num_rows();
		if ($cek > 0) {
			$data = array(
				'jenis_kendala'	=>	$jenis_kendala,
			);
			$this->template->load('template','jenis_kendala/v_edit',$data);
		} else {
			$this->session->set_flashdata('error', "Data Jenis Kendala <b>$id</b> tidak ada.");
			redirect('jenis_kendala');
		}	
	}
	
	public function proses_edit()
	{	
		
		if(isset($_POST['submit'])){
			$id_jenis_kendala    =  $this->input->post('id_jenis_kendala');
			$nama_jenis_kendala	=  $this->input->post('nama_jenis_kendala');
			
			$data       =  array('nama_jenis_kendala'=>strtoupper($nama_jenis_kendala));
			$jenis_kendala = $this->M_Jenis_Kendala->edit($data, $id_jenis_kendala);	
			$error = $this->db->error();
			if ($error['code'] == null) {
				$this->session->set_flashdata('success', "Data Jenis Kendala <b>Berhasil</b>  diedit");
			} else {
				$this->session->set_flashdata('error', "Data Jenis Kendala <b>Gagal</b> diedit. <br>Error:".$error['message']);
			}	
			
			redirect('jenis_kendala');
		}	
	}
	
	public function hapus($id)
	{
		$cek = $this->M_Jenis_Kendala->get_one($id)->num_rows();
		if ($cek > 0) {
			$jenis_kendala = $this->M_Jenis_Kendala->hapus($id);
			$error = $this->db->error();
			if ($error['code'] == null) {
				$this->session->set_flashdata('success', "Data Jenis Kendala <b>Berhasil</b>  dihapus");
			} else {
				$this->session->set_flashdata('error', "Data Jenis Kendala <b>Gagal</b> dihapus. <br>Error:".$error['message']);
			}
			
			redirect('jenis_kendala');
		} else {
			$this->session->set_flashdata('error', "Data Unit <b>$id</b> tidak ada.");
			echo "error";
			redirect('jenis_kendala');
		}	
	}
	
	
}

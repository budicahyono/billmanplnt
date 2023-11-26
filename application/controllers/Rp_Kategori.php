<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Rp_Kategori extends CI_Controller {
	function __construct(){
				parent::__construct();
						
				$this->load->model('M_Admin');
				$this->load->model('M_Rp_Kategori');
				is_login("yes");
				
		}
		
	public function index()
	{
		$data = array(
			'rp_kategori'	=>	$this->M_Rp_Kategori->get_all(),
		);
		$this->template->load('template','rp_kategori/v_index',$data);
	}
	
	
	
	public function tambah()
	{
		$data = array(
			'rp_kategori'	=>	$this->M_Rp_Kategori->get_all(),
		);
		$this->template->load('template','rp_kategori/v_tambah',$data);
	}
	
	public function post()
	{	
		if(isset($_POST['submit'])){
			$nama_rp_kategori	=  $this->input->post('nama_rp_kategori');
			$rp_bawah			=  $this->input->post('rp_bawah');
			$rp_atas			=  $this->input->post('rp_atas');
			
			if ($rp_bawah < $rp_atas) {
			
				$data  		=  array('nama_rp_kategori'=>ucwords($nama_rp_kategori),
									 'rp_bawah'	=> $rp_bawah,
									 'rp_atas'=> $rp_atas);
					$rp_kategori = $this->M_Rp_Kategori->post($data);	
					$error = $this->db->error();
					if ($error['code'] == null) {
						$this->session->set_flashdata('success', "Data Rp Kategori <b>Berhasil</b>  disimpan");
					} else {
						$this->session->set_flashdata('error', "Data Rp Kategori <b>Gagal</b> disimpan. <br>Error:".$error['message']);
					}	
					
					redirect('rp_kategori');
			
			} else {
				$this->session->set_flashdata('error', "Rp Bawah <b>harus</b> lebih kecil dari Rp Atas ");
				redirect('rp_kategori');
			}		
			
		}	
	}
	
	public function edit($id)
	{
		$rp_kategori = $this->M_Rp_Kategori->get_one($id);
		$cek = $rp_kategori->num_rows();
		if ($cek > 0) {
			$data = array(
				'rp_kategori'	=>	$rp_kategori,
			);
			$this->template->load('template','rp_kategori/v_edit',$data);
		} else {
			$this->session->set_flashdata('error', "Data Unit <b>$id</b> tidak ada.");
			redirect('rp_kategori');
		}	
	}
	
	public function proses_edit()
	{	
		
		if(isset($_POST['submit'])){
			$id_rp_kategori  =  $this->input->post('id_rp_kategori');
			$nama_rp_kategori=  $this->input->post('nama_rp_kategori');
			$rp_bawah	=  $this->input->post('rp_bawah');
			$rp_atas	=  $this->input->post('rp_atas');
			
			$data  		=  array('nama_rp_kategori'=>ucwords($nama_rp_kategori),
								 'rp_bawah'	=> $rp_bawah,
								 'rp_atas'	=> $rp_atas);
			$rp_kategori = $this->M_Rp_Kategori->edit($data, $id_rp_kategori);	
			$error = $this->db->error();
			if ($error['code'] == null) {
				$this->session->set_flashdata('success', "Data Rp Kategori <b>Berhasil</b>  diedit");
			} else {
				$this->session->set_flashdata('error', "Data Rp Kategori <b>Gagal</b> diedit. <br>Error:".$error['message']);
			}	
			
			redirect('rp_kategori');
		}	
	}
	
	public function hapus($id)
	{
		$cek = $this->M_Rp_Kategori->get_one($id)->num_rows();
		if ($cek > 0) {
			$rp_kategori = $this->M_Rp_Kategori->hapus($id);
			$error = $this->db->error();
			if ($error['code'] == null) {
				$this->session->set_flashdata('success', "Data Rp Kategori <b>Berhasil</b>  dihapus");
			} else {
				$this->session->set_flashdata('error', "Data Rp Kategori <b>Gagal</b> dihapus. <br>Error:".$error['message']);
			}
			
			redirect('rp_kategori');
		} else {
			$this->session->set_flashdata('error', "Data Unit <b>$id</b> tidak ada.");
			echo "error";
			redirect('rp_kategori');
		}		
	}
	
}

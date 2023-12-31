<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller {
	function __construct(){
				parent::__construct();
						
				$this->load->model('M_Admin');
				$this->load->model('M_Petugas');
				$this->load->model('M_Unit');
				is_login("yes");
				 
		}
		
	public function index()
	{
		$data = array(
			'petugas'	=>	$this->M_Petugas->get_all(),
			'unit'		=>	$this->M_Unit->get_all(),
		);
		$this->template->load('template','petugas/v_index',$data);
	}
	
	
	
	public function tambah()
	{
		$data = array(
			'petugas'	=>	$this->M_Petugas->get_all(),
			'unit'		=>	$this->M_Unit->get_all(),
		);
		$this->template->load('template','petugas/v_tambah',$data);
	}
	
	public function post()
	{	
		if(isset($_POST['submit'])){
			$nama_petugas	=  $this->input->post('nama_petugas');
			$username		=  $this->input->post('username');
			$password		=  $this->input->post('password');
			$password_again		=  $this->input->post('password_again');
			$is_petugas_khusus	=  $this->input->post('is_petugas_khusus');
			if ($is_petugas_khusus == "") {
				$is_petugas_khusus = 0;
			}	
			$id_unit				=  $this->input->post('id_unit');
			$cek_petugas = $this->db->query("SELECT * FROM petugas WHERE username = '$username'  ")->num_rows();
			if($password != $password_again) {
				$this->session->set_flashdata('error', "Password tidak sama");
				redirect('petugas/tambah');
			} else if($cek_petugas > 0) {
				$this->session->set_flashdata('error', "Username petugas sudah ada, Ganti username petugas lain");
				redirect("petugas/tambah");	
			} else {
				$data  		=  array('nama_petugas'	=>strtoupper($nama_petugas),
								 'username'		=>$username,
								 'password'		=>md5($password),
								 'is_petugas_khusus'		=>$is_petugas_khusus,
								 'id_unit'					=>$id_unit);
				$petugas = $this->M_Petugas->post($data);	
				$error = $this->db->error();
				if ($error['code'] == null) {
					$this->session->set_flashdata('success', "Data Petugas <b>Berhasil</b>  disimpan");
				} else {
					$this->session->set_flashdata('error', "Data Petugas <b>Gagal</b> disimpan. <br>Error:".$error['message']);
				}
				
				redirect('petugas');
			}
		}	
	}
	
	public function unit($id)
	{
		if ($id == 0) {
				redirect('petugas');
		} else {		
			$petugas = $this->M_Petugas->by_unit($id);
			$cek = $petugas->num_rows();
			if ($cek > 0) {
				$data = array(
					'petugas'	=>	$petugas,
					'unit'		=>	$this->M_Unit->get_all(),
					'id_unit'	=>	$id,
				);
				$this->template->load('template','petugas/v_index',$data);
					
			} else {
				$this->session->set_flashdata('error', "Data Petugas di Unit <b>$id</b> tidak ada.");
				redirect('petugas');
			}
		}	
	}
	
	public function edit($id)
	{
		$petugas = $this->M_Petugas->get_one($id);
		$cek = $petugas->num_rows();
		if ($cek > 0) {
			$data = array(
				'petugas'	=>	$petugas,
				'unit'		=>	$this->M_Unit->get_all(),
			);
			$this->template->load('template','petugas/v_edit',$data);
		} else {
			$this->session->set_flashdata('error', "Data Petugas <b>$id</b> tidak ada.");
			redirect('petugas');
		}		
	}
	
	public function proses_edit()
	{	
		
		if(isset($_POST['submit'])){
			$id_petugas    	=  $this->input->post('id_petugas');
			$nama_petugas	=  $this->input->post('nama_petugas');
			$username		=  $this->input->post('username');
			$password		=  $this->input->post('password');
			$password_again =  $this->input->post('password_again');
			$level			=  $this->input->post('level');
			$is_petugas_khusus	=  $this->input->post('is_petugas_khusus');
			if ($is_petugas_khusus == "") {
				$is_petugas_khusus = 0;
			}	
			$id_unit 			=  $this->input->post('id_unit');
			$password_old			=  $this->input->post('password_old'); //ambil password lama
			$cek_petugas = $this->db->query("SELECT * FROM petugas WHERE username = '$username' and id_petugas NOT IN(SELECT id_petugas FROM petugas WHERE id_petugas = '$id_petugas') ")->num_rows();
			if ($password == "" && $password_again == "") { //jika password tidak diubah
				$password = $password_old;
				$password_again = $password_old;
			} 
			if($password != $password_again) {
				$this->session->set_flashdata('error', "Password tidak sama");
				redirect("petugas/edit/$id_petugas");
			} else if($cek_petugas > 0) {
				$this->session->set_flashdata('error', "username petugas sudah ada, Ganti username petugas lain");
				redirect("petugas/edit/$id_petugas");
			} else {	
				$data       =  array('nama_petugas'	=>strtoupper($nama_petugas),
									 'username'		=>$username,
									 'password'		=>md5($password),
									 'level'		=>$level,
									 'is_petugas_khusus'		=>$is_petugas_khusus,
									 'id_unit'					=>$id_unit,
									 'last_login'				=>$last_login);
				$petugas = $this->M_Petugas->edit($data, $id_petugas);	
				$error = $this->db->error();
				if ($error['code'] == null) {
					$this->session->set_flashdata('success', "Data Petugas <b>Berhasil</b>  diedit");
				} else {
					$this->session->set_flashdata('error', "Data Petugas <b>Gagal</b> diedit. <br>Error:".$error['message']);
				}
				redirect('petugas');
			}	
		}	
	}
	
	public function hapus($id)
	{
		$cek = $this->M_Petugas->get_one($id)->num_rows();
		if ($cek > 0) {
			$petugas = $this->M_Petugas->hapus($id);
			$error = $this->db->error();
			if ($error['code'] == null) {
				$this->session->set_flashdata('success', "Data Petugas <b>Berhasil</b>  dihapus");
			} else {
				$this->session->set_flashdata('error', "Data Petugas <b>Gagal</b> dihapus. <br>Error:".$error['message']);
			}
			
			redirect('petugas');
		} else {
			$this->session->set_flashdata('error', "Data Unit <b>$id</b> tidak ada.");
			echo "error";
			redirect('petugas');
		}		
	}
	
	
}

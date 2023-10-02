<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
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
					$j   = substr($date, 11, 2);
					$m   = substr($date, 14, 2);
					$d   = substr($date, 17, 2);
					$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun . " " . $j.":".$m.":".$d ;		
					return $result;
				}
				
				
				 
		}
		
	public function index()
	{
		$data = array(
			'app' 	=> 'Billman PLN-T',
			'title' =>	ucfirst($this->uri->segment(1)),
			'admin'	=>	$this->M_Admin->get_all(),
		);
		$this->template->load('template','admin/v_index',$data);
	}
	
	public function profil()
	{
		$data = array(
			'app' => 'Billman PLN-T',
			'title' => ucfirst($this->uri->segment(1)),
		);
		$this->template->load('template','v_profil',$data);
	}
	
	public function tambah()
	{
		$data = array(
			'app' 	=> 'Billman PLN-T',
			'title' =>	ucfirst($this->uri->segment(1)),
			'admin'	=>	$this->M_Admin->get_all(),
		);
		$this->template->load('template','admin/v_tambah',$data);
	}
	
	public function post()
	{	

		if(isset($_POST['submit'])){
			$nama_admin   			=  $this->input->post('nama_admin');
			$username   			=  $this->input->post('username');
			$level   			 	=  $this->input->post('level');
			$password        		=  $this->input->post('password');
			$password_again        	=  $this->input->post('password_again');
			$cek_admin = $this->db->query("SELECT * FROM admin WHERE username = '$username'  ")->num_rows();
			if($password != $password_again) {
				$this->session->set_flashdata('error', "Password tidak sama");
				redirect('admin/tambah');
				} else if($cek_admin > 0) {
				$this->session->set_flashdata('error', "Username sudah ada, Ganti username lain");
				redirect("admin/tambah");	
				}  else {		
				$data           		=  array('level'       =>$level,
				'nama_admin'    =>$nama_admin,
				'username'    =>$username,
				'password'    =>md5($password));
				$this->M_Admin->post($data);	
				$this->session->set_flashdata('success', "Data Admin <b>Berhasil</b>  disimpan");
				redirect('admin');
			}
		}	
	}
	
	public function edit($id)
	{
		$data = array(
			'app' 	=> 'Billman PLN-T',
			'title' =>	ucfirst($this->uri->segment(1)),
			'admin'	=>	$this->M_Admin->get_one($id),
		);
		$this->template->load('template','admin/v_edit',$data);
	}
	
	public function proses_edit()
	{	
		$data['title'] 	= ucfirst($this->uri->segment(1));
		$data['app'] 	= 'Billman PLN-T';
		if(isset($_POST['submit'])){
			$id_admin       	 	=  $this->input->post('id_admin');
			$nama_admin       	 	=  $this->input->post('nama_admin');
			$username   			=  $this->input->post('username');
			$level   			 	=  $this->input->post('level');
			$password        		=  $this->input->post('password');
			$password_again        	=  $this->input->post('password_again');
			$cek_admin = $this->db->query("SELECT * FROM admin WHERE username = '$username' and id_admin NOT IN(SELECT id_admin FROM admin WHERE id_admin = '$id_admin') ")->num_rows();
			if ($password == "" || $password_again == "") {
				if($cek_admin > 0) {
					$this->session->set_flashdata('error', "username sudah ada, Ganti username lain");
					redirect("admin/edit/$id_admin");
				} else {	
					$data           =  array('level'       =>$level,
					'nama_admin'       =>$nama_admin,
					'username'       =>$username,
					'password'       =>md5($password));
					$this->M_Admin->edit($data, $id_admin);	
					$this->session->set_flashdata('status', "Data Admin <b>Berhasil</b>  diedit");
					redirect('admin');
				}	
			} else {
				if($password != $password_again) {
					$this->session->set_flashdata('error', "Password tidak sama");
					redirect("admin/edit/$id_admin");
				} else if($cek_admin > 0) {
					$this->session->set_flashdata('error', "username sudah ada, Ganti username lain");
					redirect("admin/edit/$id_admin");
				} else {	
					$data           =  array('level'       =>$level,
					'nama_admin'       =>$nama_admin,
					'username'       =>$username,
					'password'       =>md5($password));
					$this->M_Admin->edit($data, $id_admin);	
					$this->session->set_flashdata('status', "Data Admin <b>Berhasil</b>  diedit");
					redirect('admin');
				}
			}
			
		}	
	}
	
	public function hapus($id)
	{
		
		$this->M_Admin->hapus($id);
		$this->session->set_flashdata('success', "Data Admin <b>Berhasil</b>  dihapus");
		redirect('admin');
	}
	
}

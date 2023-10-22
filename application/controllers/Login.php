<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller { 
	// nama controller, biasa dalam URL ditulis setelah alamat websitenya, (website.com/login) tapi karena controller ini dijadikan sebagai default controller pada routes.php maka hanya tulis URL alamat websitenya saja (website.com)

	function __construct(){
		parent::__construct();
		$this->load->model('M_Admin'); // panggil model admin
		
		function bln_indo($date)
		{
			$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		 
			
			$bulan = $date;
			 
		 
			$result =   $BulanIndo[(int)$bulan-1] ;		
			return($result);
		}
	}
		
		
	public function index() // method default dari controller ini 
	{
		if ($this->M_Admin->is_login()) { // jika sudah login maka dilempar ke halaman dashboard
				redirect("dashboard");		
		} 	
		
		$data = array(
			'app' => 'Billman PLN-T',
			'title' => 'Login',
		);
		$this->template->load('temp_home','v_login', $data);
	}
	
	public function check()
	{
	
		if (isset($_POST['submit'])) {
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			
			$bulan_sess = $this->input->post('bulan'); //ambil bulan
			$tahun_sess = $this->input->post('tahun'); //ambil tahun
			
			$where = array(
				'username' => $username,
				'password' => $password,
			);
			$data_admin = $this->M_Admin->check($where);
			$cek_admin = $this->M_Admin->check($where)->num_rows();
			if($cek_admin > 0){
			
				foreach ($data_admin->result() as $r) {
					$data_session = array(
					'nama_admin' 	=> $r->nama_admin,
					'username' 		=> $r->username,
					'level' 		=> $r->level,
					'id_admin' 		=> $r->id_admin,
					'is_admin_unit' => $r->is_admin_unit,
					'bulan_sess' 		=> $bulan_sess, //simpan dalam session
					'tahun_sess' 		=> $tahun_sess, //simpan dalam session
					);
				
					$last_login = date("Y-m-d H:i:s");
					$edit = $this->M_Admin->edit(array('last_login' => $last_login), $r->id_admin);	
					
				}
				
				
				$this->session->set_userdata($data_session);
				$this->session->set_flashdata('success', 'Username dan Password benar, Anda berhasil login!!');
				redirect("dashboard");
			}else{	
				$this->session->set_flashdata('error', 'Maaf Username dan Password salah, gagal login!');
				redirect(".");
			}
			
		}  else {
			redirect(".");
		}
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect("login/sampai_jumpa");
	}
		
		
		
	public function profil() // method default dari controller ini 
	{
		if (!$this->M_Admin->is_login()) { // jika belum login (tanda ! didepan) maka dilempar ke halaman awal
				redirect(".");		
			} 	
		
		$data = array(
			'app' => 'Billman PLN-T',
			'title' => 'Profil Admin',
		);
		$this->template->load('template','v_profil', $data);
	}
		
		
	public function sampai_jumpa(){
		$this->session->set_flashdata('success', 'Anda telah logout, sampai jumpa!!');
		redirect(".");
	}
}

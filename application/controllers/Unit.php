<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {
	function __construct(){
				parent::__construct();
						
				$this->load->model('M_Admin');
				$this->load->model('M_Unit');
				is_login("yes");
		}
		
	public function index()
	{
		$data = array(
			'unit'	=>	$this->M_Unit->get_all(),
		);
		$this->template->load('template','unit/v_index',$data);
	}
	
	
	
	public function tambah()
	{
		$data = array(
			'unit'	=>	$this->M_Unit->get_all(),
		);
		$this->template->load('template','unit/v_tambah',$data);
	}
	
	public function post()
	{	
		if(isset($_POST['submit'])){
			$nama_unit	=  $this->input->post('nama_unit');
			$data  		=  array('nama_unit'=>strtoupper($nama_unit));
				$unit = $this->M_Unit->post($data);	
				$error = $this->db->error();
				if ($error['code'] == null) {
					$this->session->set_flashdata('success', "Data Unit <b>Berhasil</b>  disimpan");
					
				} else {
					$this->session->set_flashdata('error', "Data Unit <b>Gagal</b> disimpan. <br>Error:".$error['message']);
				}	
				redirect('unit');
			
		}	
	}
	
	
	
	public function edit($id)
	{
		$unit = $this->M_Unit->get_one($id);
		$cek = $unit->num_rows();
		if ($cek > 0) {
			$data = array(
				'unit'	=>	$unit,
			);
			$this->template->load('template','unit/v_edit',$data);
		} else {
			$this->session->set_flashdata('error', "Data Unit <b>$id</b> tidak ada.");
			redirect('unit');
		}	
	}
	
	public function proses_edit()
	{	
		
		if(isset($_POST['submit'])){
			$id_unit    =  $this->input->post('id_unit');
			$nama_unit	=  $this->input->post('nama_unit');
			
			$data       =  array('nama_unit'=>strtoupper($nama_unit));
			$unit = $this->M_Unit->edit($data, $id_unit);	
			$error = $this->db->error();
			if ($error['code'] == null) {
				$this->session->set_flashdata('success', "Data Unit <b>Berhasil</b>  diedit");
			} else {
				$this->session->set_flashdata('error', "Data Unit <b>Gagal</b> diedit. <br>Error:".$error['message']);
			}	
			redirect('unit');
		}	
	}
	
	public function hapus($id)
	{
		$cek = $this->M_Unit->get_one($id)->num_rows();
		if ($cek > 0) {
			$unit = $this->M_Unit->hapus($id);
			$error = $this->db->error();
			
			if ($error['code'] == null) {
				$this->session->set_flashdata('success', "Data Unit <b>Berhasil</b>  dihapus");
			} else {
				$this->session->set_flashdata('error', "Data Unit <b>Gagal</b> dihapus. <br>Error:".$error['message']);
			}
			redirect('unit');
			
		} else {
			$this->session->set_flashdata('error', "Data Unit <b>$id</b> tidak ada.");
			echo "error";
			redirect('unit');
		}	
	}
	
	
}

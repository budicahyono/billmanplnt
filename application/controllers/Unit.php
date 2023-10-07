<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {
	function __construct(){
				parent::__construct();
						
				$this->load->model('M_Admin');
				$this->load->model('M_Unit');
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
			'unit'	=>	$this->M_Unit->get_all(),
		);
		$this->template->load('template','unit/v_index',$data);
	}
	
	
	
	public function tambah()
	{
		$data = array(
			'app' 	=> 'Billman PLN-T',
			'title' =>	ucfirst($this->uri->segment(1)),
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
				if ($unit) {
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
				'app' 	=> 'Billman PLN-T',
				'title' =>	ucfirst($this->uri->segment(1)),
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
		$data['title'] 	= ucfirst($this->uri->segment(1));
		$data['app'] 	= 'Billman PLN-T';
		if(isset($_POST['submit'])){
			$id_unit    =  $this->input->post('id_unit');
			$nama_unit	=  $this->input->post('nama_unit');
			
			$data       =  array('nama_unit'=>strtoupper($nama_unit));
			$unit = $this->M_Unit->edit($data, $id_unit);	
			$error = $this->db->error();
			if ($unit) {
				$this->session->set_flashdata('success', "Data Unit <b>Berhasil</b>  diedit");
			} else {
				$this->session->set_flashdata('error', "Data Unit <b>Gagal</b> diedit. <br>Error:".$error['message']);
			}	
			redirect('unit');
		}	
	}
	
	public function hapus($id)
	{
		
		$unit = $this->M_Unit->hapus($id);
		$error = $this->db->error();

		if ($unit) {
			$this->session->set_flashdata('success', "Data Unit <b>Berhasil</b>  dihapus");
		} else {
			$this->session->set_flashdata('error', "Data Unit <b>Gagal</b> dihapus. <br>Error:".$error['message']);
		}
		redirect('unit');
	}
	
	
}

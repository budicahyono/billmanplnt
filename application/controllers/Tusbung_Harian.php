<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

// Include librari PhpSpreadsheet
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	//use PhpOffice\PhpSpreadsheet\IOFactory;

class Tusbung_Harian extends CI_Controller {
	function __construct(){
				parent::__construct();
						
				$this->load->model('M_Admin');
				$this->load->model('M_Unit');
				$this->load->model('M_Petugas');
				$this->load->model('M_Pelanggan');
				$this->load->model('M_Tusbung');
				$this->load->model('M_Jenis_Kendala');
				$this->load->model('M_Tusbung_Harian');
				$this->load->model('M_Kendala_Harian');
				is_login("yes");
		}
		
	
	
	
	
	
	public function import()
	{
		$data = array(
			'unit'	=>	$this->M_Unit->get_all(),
		);
		$this->template->load('template','tusbung_harian/v_import',$data);
	}
	
	
	public function save()
	{	
		$tgl = $this->input->post('tgl',TRUE);
		$tgl_kendala = $_SESSION['tahun_sess']."-".$_SESSION['bulan_sess']."-".$tgl;
		
		$isi_kendala = $this->input->post('kendala_harian',TRUE);
		$id_petugas = $this->input->post('id_petugas_kendala',TRUE);
		$data   =  array('id_petugas'  =>$id_petugas,
						 'isi_kendala' =>strtoupper($isi_kendala),
						 'tgl_kendala' =>$tgl_kendala);
		$kendala_harian = $this->M_Kendala_Harian->post($data);
		$error = $this->db->error();
		if ($error['code'] == null) {
			$this->session->set_flashdata('success', "Data Kendala Harian <b>Berhasil</b>  disimpan");
		} else {
			$this->session->set_flashdata('error', "Data Kendala Harian <b>Gagal</b> disimpan. <br>Error:".$error['message']);
		}	 
	}	
	
	public function edit()
	{	
		$tgl = $this->input->post('tgl',TRUE);
		$tgl_kendala = $_SESSION['tahun_sess']."-".$_SESSION['bulan_sess']."-".$tgl;
		
		$isi_kendala = $this->input->post('kendala_harian',TRUE);
		$id_petugas = $this->input->post('id_petugas_kendala',TRUE);
		$id_kendala_harian = $this->input->post('id_kendala_harian',TRUE);
		$data   =  array('id_petugas'  =>$id_petugas,
						 'isi_kendala' =>strtoupper($isi_kendala),
						 'tgl_kendala' =>$tgl_kendala);
		$kendala_harian = $this->M_Kendala_Harian->edit($data, $id_kendala_harian);
		$error = $this->db->error();
		if ($error['code'] == null) {
			$this->session->set_flashdata('success', "Data Kendala Harian <b>Berhasil</b>  disimpan");
		} else {
			$this->session->set_flashdata('error', "Data Kendala Harian <b>Gagal</b> disimpan. <br>Error:".$error['message']);
		}	 
	}	
	
	
	public function hasil_import()
	{	
		
		
		if(isset($_POST['submit'])){
			
			
			$namafile = "import_tusbung_harian";
			
			$bulan   		 =  $_SESSION['bulan_sess'];
			$tahun   		 =  $_SESSION['tahun_sess'];
			$id_unit   		 =  $this->input->post('id_unit');
			$tanggal   		 =  $this->input->post('tanggal');
			
			$tgl_tusbung = $tahun."-".$bulan."-".$tanggal; //satukan inputan dlm tanggal yg utuh
			
			$unit = $this->M_Unit->get_one($id_unit);
			foreach ($unit->result() as $r) {
				$nama_unit = ucfirst(strtolower($r->nama_unit));
			}
			
			$this->load->library('upload'); 
			$config['upload_path'] = './import/';    
			$config['allowed_types'] = 'xlsx';    
			$config['max_size']  = '10000';    
			$config['overwrite'] = true;    
			$config['file_name'] = $namafile;      
			$this->upload->initialize($config); 		
			
			if($this->upload->do_upload('file')){ 
				$tusbung_harian = array(); 
				$duplikat_pelanggan = array(); 
			   
			   
			   // Panggil class PHPExcel nya
				$spreadsheet = new  \PhpOffice\PhpSpreadsheet\Reader\Xlsx();    
				$loadexcel = $spreadsheet->load('import/'.$namafile.'.xlsx'); 
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);    
				       
				$numrow = 1;    
				foreach($sheet as $row){      
					if($numrow > 1){     
						
						$kendala = $row['M'];
						$jenis_kendala = $this->M_Jenis_Kendala->get_by_nama($kendala);
						if ($jenis_kendala->num_rows() > 0) {
							foreach ($jenis_kendala->result() as $r) {
								$id_jenis_kendala = $r->id_jenis_kendala;
							}
							$is_evidence = 1; // jika ada data jadikan evidence 1
						} else {
							//$this->session->set_flashdata('error', "Tidak ada jenis kendala dengan nama <b>$kendala</b> pada data master");
							//redirect("tusbung_harian/import"); 
							$id_jenis_kendala = 0;
							$is_evidence = 0;
						}	
						
						
						
						
						//cek dulu idpelanggan dan tanggal yg sama
						$id_pelanggan = $row['A'];
						$pelanggan_harian = $this->M_Tusbung_Harian->cek($id_pelanggan, $tgl_tusbung)->num_rows();
						
						//cek petugas sudah sesuai dengan di data petugas 
						$nama_petugas = $row['J'];
						$petugas = $this->M_Petugas->cek($nama_petugas);
						if ($petugas->num_rows() == 0) {
							$this->session->set_flashdata('error', "Tidak ada petugas dengan nama <b>$nama_petugas</b> pada data master");
							redirect("tusbung_harian/import"); 
						} 	
						
						
							
						
						if ($pelanggan_harian == 0) { // kalau kosong
							//cek lagi di pelanggan dan tusbung kumulatif
							$pelanggan = $this->M_Pelanggan->cek($id_pelanggan)->num_rows();
							$where = array(
								'id_pelanggan' => $id_pelanggan,
								'bulan' => $bulan,
								'tahun' => $tahun,
							);
							$tusbung = $this->M_Tusbung->cek($where)->num_rows();
							if ($pelanggan != 0 && $tusbung != 0) {
								if ($petugas->num_rows() > 0) {
									foreach ($petugas->result() as $r) {
										if ($r->is_petugas_khusus == 1) { 
										//jika petugas khusus ambil id_petugasnya
										$id_petugas = $r->id_petugas;
										
										//update id_petugas_khusus di tusbung_kumulatif 
										$edit = array('id_petugas_khusus'	=>$id_petugas);
										$this->M_Tusbung->edit_by_bln_thn($edit, $id_pelanggan, $bulan, $tahun);	
										} else {
										//null kan id_petugas_khusus di tusbung_kumulatif 
										$edit = array('id_petugas_khusus'	=>null);
										$this->M_Tusbung->edit_by_bln_thn($edit, $id_pelanggan, $bulan, $tahun);	
										}
									} 
								}	
								
								//input ke tabel tusbung_harian 
								array_push($tusbung_harian, [          
									'id_pelanggan' 		=>$id_pelanggan,    
									'tgl_tusbung'    	=>$tgl_tusbung,   
									'is_evidence'     	=>$is_evidence, 
									'id_jenis_kendala'  =>$id_jenis_kendala
								]); 
							} else {
								if ($pelanggan == 0 && $tusbung == 0) {
									$this->session->set_flashdata('error', "Tidak ada data pelanggan dengan ID <b>$id_pelanggan</b> maupun di tusbung kumulatif pada bulan <b>$bulan</b> dan tahun <b>$tahun</b>");
								}
								if ($tusbung == 0) {
									$this->session->set_flashdata('error', "Tidak ada data tusbung kumulatif dengan ID pelanggan <b>$id_pelanggan</b> pada bulan <b>$bulan</b> dan tahun <b>$tahun</b>");
								}
								redirect("tusbung_harian/import"); 
							}	
						} else { // kalau ada data masukkan dalam array duplikat
							array_push($duplikat_pelanggan, [          
								'id_pelanggan' 		=>$id_pelanggan,   
								'nama_pelanggan'    =>$row['B'],   
								'tarif'     		=>$row['C'], 
								'daya'     			=>$row['D'],   
								'gol'				=>$row['E'],  
								'alamat'			=>$row['F'],  
								'kddk'				=>$row['G'],  
								'is_evidence'     	=>$is_evidence, 
								'no_hp'				=>$row['M'], 
								'tgl_tusbung'    	=>$tgl_tusbung, 
								'id_jenis_kendala'  =>$id_jenis_kendala,
								
							]); 
						}
						
						//update di tusbung kumulatif utk yg belum lunas
						$lunas = $row['P'];
						if ($lunas == "lunas") {
							$is_lunas = 1;
							$tgl_lunas = $tgl_tusbung;
							$edit = array('is_lunas'	 	=> $is_lunas, 
										  'tgl_lunas' 	 	=> $tgl_lunas,
										  'id_jenis_kendala'=> $id_jenis_kendala);	  
						} else {
							$edit = array('id_jenis_kendala'=> $id_jenis_kendala);	  
						}
						
						$this->M_Tusbung->edit_by_bln_thn($edit, $id_pelanggan, $bulan, $tahun);
							
					}            
					
					$numrow++;    
				} 
				
				
				$sum_tusbung_harian = count($tusbung_harian);
				$sum_duplikat = count($duplikat_pelanggan);
				//masukkan dalam proses query tapi dicek dulu jumlah array dalam data
				if ($sum_tusbung_harian > 0) {
					$this->M_Tusbung_Harian->insert_multiple($tusbung_harian);  
				}
				$total = $sum_tusbung_harian + $sum_duplikat;	
				
				
				if (count($duplikat_pelanggan) > 100 ) { 
					$this->session->set_flashdata('error', "Terlalu banyak data Tusbung Harian yang <b>Duplikat</b>");
					redirect("tusbung_harian/import"); 
				}
				
				if ($sum_duplikat > 0 ) { 
					$this->session->set_flashdata('error', "Data Tusbung Harian ada yang <b>Duplikat</b>!! gagal diimport");
				} else {
					$this->session->set_flashdata('success', "Data Tusbung Harian <b>Berhasil</b>  diimport");
				}
				
				$data = array(
					'app' => 'Billman SAYA',
					'title' => "Hasil Import Tusbung Harian",
					'id_unit' => $id_unit,
					'nama_unit' => $nama_unit,
					'sum_duplikat' => $sum_duplikat,
					'sum_tusbung_harian' => $sum_tusbung_harian,
					'tusbung_harian' => $tusbung_harian,
					'duplikat_pelanggan' => $duplikat_pelanggan,
					'total' => $total,
				);
				
				
				
				$this->template->load('template','tusbung_harian/v_hasil',$data);
				unlink("import/$namafile.xlsx");
				
			}else{ 
				$error =  $this->upload->display_errors();   
				$this->session->set_flashdata('error', "Data Tusbung Harian <b>Gagal</b>  diimport. Error :" . $error);echo "gagal";
				redirect("tusbung_harian/import"); 
			}  
			
			
			
		}	
	}
	
	public function back($opsi = null)
	{
		if ($opsi == null) { 
			redirect("tusbung_harian/import"); 
		} else {
			redirect("tusbung_harian/update_lunas"); 
		}	
	}
	
	public function next()
	{
		if (isset($_GET['id_unit'])) {
			$id_unit = $_GET['id_unit'];
		} else {
			$id_unit = 1;
			
		}
		redirect("tusbung_harian?id_unit=$id_unit"); 
	}
	
	
	public function petugas($id_petugas = null)
	{
		
		(isset($_GET['tgl'])) 		? $tgl = $_GET['tgl'] 			: $tgl = null;
		(isset($_GET['limit'])) 	? $limit = $_GET['limit'] 		: $limit = null;
		(isset($_GET['q'])) 		? $q = $_GET['q'] 				: $q = null;
		(isset($_GET['jenis'])) 	? $jenis = $_GET['jenis'] 		: $jenis = null;
		(isset($_GET['total'])) 	? $total = $_GET['total'] 		: $total = null;
		(isset($_GET['id_k'])) 		? $id_petugas_khusus = $_GET['id_k'] 		: $id_petugas_khusus = null;
		
		
		if ($total == null) {
			if ($jenis == "tul") {
				if ($q != null) {
					$tusbung = $this->M_Tusbung_Harian->get_tul_petugas($id_petugas, $tgl, $id_petugas_khusus, null, $q);
				} else {
					$tusbung = $this->M_Tusbung_Harian->get_tul_petugas($id_petugas, $tgl, $id_petugas_khusus, $limit, null);
				}
			} else if ($jenis == "lunas") {
				if ($q != null) {
					$tusbung = $this->M_Tusbung_Harian->get_lunas_petugas($id_petugas, $tgl, $id_petugas_khusus, null, $q);
				} else {
					$tusbung = $this->M_Tusbung_Harian->get_lunas_petugas($id_petugas, $tgl, $id_petugas_khusus, $limit, null);
				}
			} else {
				if ($q != null) {
					$tusbung = $this->M_Tusbung_Harian->get_tul_blm($id_petugas, $tgl, $id_petugas_khusus, null, $q);
				} else {
					$tusbung = $this->M_Tusbung_Harian->get_tul_blm($id_petugas, $tgl, $id_petugas_khusus, $limit, null);
				}
			}
		} else {	
			if ($jenis == "tul") {
				if ($q != null) {
					$tusbung = $this->M_Tusbung_Harian->get_tul($tgl, null, $q);
				} else {
					$tusbung = $this->M_Tusbung_Harian->get_tul($tgl, $limit, null);
				}
			} else if ($jenis == "lunas") {
				if ($q != null) {
					$tusbung = $this->M_Tusbung_Harian->get_lunas($tgl, null, $q);
				} else {
					$tusbung = $this->M_Tusbung_Harian->get_lunas($tgl, $limit, null);
				}
			} else {
				if ($q != null) {
					$tusbung = $this->M_Tusbung_Harian->get_blm($tgl, null, $q);
				} else {
					$tusbung = $this->M_Tusbung_Harian->get_blm($tgl, $limit, null);
				}
			}
		}	
		
		$data['data_rows'] = array();
		$data['total'] = $total;
		$data['total_rows'] = $tusbung->num_rows();
		foreach ($tusbung->result() as $row) {
		
			if ($row->tgl_lunas != "0000-00-00") {
				$tgl_lunas = tgl($row->tgl_lunas); 
			} else {
				$tgl_lunas = "Tidak ada"; 
			}
			
			array_push($data['data_rows'], [          
					'id_pelanggan' 			=> $row->id_pelanggan,
					'nama_pelanggan' 		=> $row->nama_pelanggan,
					'tarif' 				=> $row->tarif,
					'daya' 					=> $row->daya,
					'gol' 					=> $row->gol,
					'alamat' 				=> $row->alamat,
					'kddk' 					=> $row->kddk,
					'no_hp' 				=> $row->no_hp,
					'rptag' 				=> rp($row->rptag),
					'rbk' 					=> $row->rbk,
					'is_lunas' 				=> $row->is_lunas,
					'tgl_lunas' 			=> $tgl_lunas,
					'nama_jenis_kendala' 	=> $row->nama_jenis_kendala,
					'nama_petugas' 			=> $row->nama_petugas,
				]);
		
		}
		
		
		echo json_encode($data);
	}
	
	public function search($id_petugas = null)
	{
		
		
		(isset($_GET['tgl'])) 		? $tgl = $_GET['tgl'] 			: $tgl = null;
		(isset($_GET['limit'])) 	? $limit = $_GET['limit'] 		: $limit = null;
		(isset($_GET['q'])) 		? $q = $_GET['q'] 				: $q = null;
		(isset($_GET['jenis'])) 	? $jenis = $_GET['jenis'] 		: $jenis = null;
		(isset($_GET['total'])) 	? $total = $_GET['total'] 		: $total = null;
		(isset($_GET['id_k'])) 		? $id_petugas_khusus = $_GET['id_k'] 		: $id_petugas_khusus = null;
		
		
		if ($q != null) {
			$limit = 10;
			if ($total == null) {	
				if ($jenis == "tul") {
					$tusbung = $this->M_Tusbung_Harian->get_tul_petugas($id_petugas, $tgl, $id_petugas_khusus, $limit, $q);
				} else if ($jenis == "lunas") {
					$tusbung = $this->M_Tusbung_Harian->get_lunas_petugas($id_petugas, $tgl, $id_petugas_khusus, $limit, $q);
				} else {
					$tusbung = $this->M_Tusbung_Harian->get_tul_blm($id_petugas, $tgl, $id_petugas_khusus, $limit, $q);
				}
			} else {
				if ($jenis == "tul") {
					$tusbung = $this->M_Tusbung_Harian->get_tul($tgl, $limit, $q);
				} else if ($jenis == "lunas") {
					$tusbung = $this->M_Tusbung_Harian->get_lunas($tgl, $limit, $q);
				} else {
					$tusbung = $this->M_Tusbung_Harian->get_blm($tgl, $limit, $q);
				}
			}	
			$data['id_petugas'] = $id_petugas;
			$data['id_petugas_khusus'] = $id_petugas_khusus;
			$data['limit'] = $limit;
			$data['total_rows'] = $tusbung->num_rows();
			$data['data_rows'] = array();
			foreach ($tusbung->result() as $row)
			{
				array_push($data['data_rows'], [          
					'id_pelanggan' 			=> $row->id_pelanggan,
					'nama_pelanggan' 		=> $row->nama_pelanggan,
				]);
				
			}
			
			echo json_encode($data);
		}
	}
	
	public function detail($id_pelanggan)
	{
		$tusbung = $this->M_Tusbung->get_by_idpel($id_pelanggan);
				
		
		$data['data_rows'] = array();
		$data['total_rows'] = $tusbung->num_rows();
		foreach ($tusbung->result() as $row) {
		
			if ($row->tgl_lunas != "0000-00-00") {
				$tgl_lunas = tgl($row->tgl_lunas); 
			} else {
				$tgl_lunas = "Tidak ada"; 
			}
			
			array_push($data['data_rows'], [          
					'id_pelanggan' 			=> $row->id_pelanggan,
					'nama_pelanggan' 		=> $row->nama_pelanggan,
					'tarif' 				=> $row->tarif,
					'daya' 					=> $row->daya,
					'gol' 					=> $row->gol,
					'alamat' 				=> $row->alamat,
					'kddk' 					=> $row->kddk,
					'no_hp' 				=> $row->no_hp,
					'rptag' 				=> rp($row->rptag),
					'rbk' 					=> $row->rbk,
					'is_lunas' 				=> $row->is_lunas,
					'tgl_lunas' 			=> $tgl_lunas,
					'bulan' 				=> bln_indo($row->bulan),
					'tahun' 				=> $row->tahun,
					'nama_jenis_kendala' 	=> $row->nama_jenis_kendala,
					'nama_petugas' 			=> $row->nama_petugas,
				]);
		
		}
		
		
		echo json_encode($data);
		
		
	}
	
	
	
	public function hasil_update()
	{	
		
		
		if(isset($_POST['submit'])){
			
			
			$namafile = "import_tusbung_lunas";
			
			$bulan   		 =  $_SESSION['bulan_sess'];
			$tahun   		 =  $_SESSION['tahun_sess'];
			$id_unit   		 =  $this->input->post('id_unit');
			$tanggal   		 =  $this->input->post('tanggal');
			
			$tgl_lunas = $tahun."-".$bulan."-".$tanggal; //satukan inputan dlm tanggal yg utuh
			
			$unit = $this->M_Unit->get_one($id_unit);
			foreach ($unit->result() as $r) {
				$nama_unit = ucfirst(strtolower($r->nama_unit));
			}
			
			$this->load->library('upload'); 
			$config['upload_path'] = './import/';    
			$config['allowed_types'] = 'xlsx';    
			$config['max_size']  = '10000';    
			$config['overwrite'] = true;    
			$config['file_name'] = $namafile;      
			$this->upload->initialize($config); 		
			
			if($this->upload->do_upload('file')){ 
				$tusbung_harian = array(); 
			   
			   
			   // Panggil class PHPExcel nya
				$spreadsheet = new  \PhpOffice\PhpSpreadsheet\Reader\Xlsx();    
				$loadexcel = $spreadsheet->load('import/'.$namafile.'.xlsx'); 
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);    
				       
				$numrow = 1;    
				foreach($sheet as $row){      
					if($numrow > 1){  
					
						/*
						$kendala = $row['M'];
						$jenis_kendala = $this->M_Jenis_Kendala->get_by_nama($kendala);
						if ($jenis_kendala->num_rows() > 0) {
							foreach ($jenis_kendala->result() as $r) {
								$id_jenis_kendala = $r->id_jenis_kendala;
								if ($id_jenis_kendala != 28) { //28 = LUNAS
									$this->session->set_flashdata('error', "Tidak boleh menginput status baru selain <b>LUNAS</b> pada excel");
									redirect("tusbung_harian/update_lunas"); 
								}
							}
							
						} else {
							$this->session->set_flashdata('error', "Tidak ada jenis kendala dengan nama <b>$kendala</b> pada data master");
							redirect("tusbung_harian/update_lunas"); 
							
						}	
						*/
						
						//cek petugas sudah sesuai dengan di data petugas 
						$nama_petugas = $row['J'];
						$petugas = $this->M_Petugas->cek($nama_petugas);
						if ($petugas->num_rows() == 0) {
							$this->session->set_flashdata('error', "Tidak ada petugas dengan nama <b>$nama_petugas</b> pada data master");
							redirect("tusbung_harian/update_lunas"); 
						} else {
							foreach ($petugas->result() as $r) {
								$id_petugas = $r->id_petugas;
								
							}
						}
						
						
						//cek dulu idpelanggan, bulan, dan tahun di tusbung
						$id_pelanggan = $row['A'];
						$where = array(
								'id_pelanggan' => $id_pelanggan,
								'bulan' => $bulan,
								'tahun' => $tahun,
							);
						$tusbung = $this->M_Tusbung->cek($where)->num_rows();
							
						if ($tusbung == 0) { // kalau kosong maka error
							$this->session->set_flashdata('error', "Tidak ada data tusbung kumulatif dengan ID pelanggan <b>$id_pelanggan</b> pada bulan <b>$bulan</b> dan tahun <b>$tahun</b>");
							redirect("tusbung_harian/update_lunas"); 
						} else {
							// jika ada datanya 
							// ubah status jadi lunas, beserta tgl lunasnya 
							$lunas = $row['O'];
							if ($lunas == "lunas") { //input di excel wajib lunas
								$is_lunas = 1;
								$tgl_lunas_fix = $tgl_lunas;
								$edit = array('is_lunas' => $is_lunas, 
									  'tgl_lunas' 		 => $tgl_lunas_fix,
									  'id_jenis_kendala' => 28); //LUNAS
							} else {
								$edit = array('id_jenis_kendala' => 28); //LUNAS
							} 
							
							$this->M_Tusbung->edit_by_bln_thn($edit, $id_pelanggan, $bulan, $tahun);	
							
							
							//masukkan dalam array
							array_push($tusbung_harian, [          
								'id_pelanggan' 		=>$id_pelanggan,    
								'tgl_lunas'    		=>$tgl_lunas_fix,   
								'lunas'  			=>$lunas
							]);
						}
					}            
					
					$numrow++;    
				} 
				
				
				$sum_tusbung_harian = count($tusbung_harian);
				$this->session->set_flashdata('success', "Data Update Lunas <b>Berhasil</b>  diimport");
				
				$data = array(
					'app' => 'Billman SAYA',
					'title' => "Hasil Import Tusbung Harian",
					'id_unit' => $id_unit,
					'nama_unit' => $nama_unit,
					'sum_tusbung_harian' => $sum_tusbung_harian,
				);
				
				
				
				$this->template->load('template','tusbung_harian/v_hasil_update',$data);
				unlink("import/$namafile.xlsx");
				
			}else{ 
				$error =  $this->upload->display_errors();   
				$this->session->set_flashdata('error', "Data Update Lunas <b>Gagal</b>  diimport. Error :" . $error);echo "gagal";
				redirect("tusbung_harian/update_lunas"); 
			}  
			
			
			
		}	
	}
	
	
	
	public function index()
	{
		if (isset($_GET['id_unit'])) {
			$id_unit = $_GET['id_unit'];
		} else {
			$id_unit = 1;
		}
		
		if (isset($_GET['tgl_skrg'])) {
			$tgl_skrg = $_GET['tgl_skrg'];
		} else {
			$tgl_skrg = date("d");
			
			
		}
		
		$hari = date("l", strtotime($_SESSION['tahun_sess']."-".$_SESSION['bulan_sess']."-".$tgl_skrg));
		
		$bln_skrg = $_SESSION['bulan_sess'];
		$thn_skrg = $_SESSION['tahun_sess'];
		$jumlah_tanggal = cal_days_in_month(CAL_GREGORIAN, $bln_skrg, $thn_skrg);
		
		$tgl_rows = array();
		for ($i=1;$i<=$jumlah_tanggal;$i++){
			$opsi = ['id_unit' => $id_unit,'opsi' => 'sum','jenis' => 'tul','tgl' => $i,'tgl_opsi' => true];
			$sum_tgl = $this->M_Tusbung_Harian->get_tul($opsi)->num_rows();
			
			array_push($tgl_rows, [          
				'sum_tgl' 	=>$sum_tgl,    
				'tgl'    	=>$i
			]); 
		}
		$data['tgl_rows']	= $tgl_rows;
		$data['unit'] 		= $this->M_Unit->get_all();
		$data['tgl_skrg']   = $tgl_skrg;
		$data['hari']   	= $hari;
		$unit = $this->M_Unit->get_one($id_unit);
		foreach ($unit->result() as $r) {
			$data['nama_unit'] = $r->nama_unit;
		}
		
		if ($id_unit == null) {
			$id = 1;
		} else {
			$id = $id_unit;
		}
		
		$data['petugas'] 	= $this->M_Tusbung_Harian->by_unit($id, $id, $tgl_skrg); 
			
		//parameter kedua adalah isi dari is_petugas_khusus
		$data['petugas_khusus'] 	= $this->M_Tusbung_Harian->by_unit($id, $id, $tgl_skrg, 1); 
		$data['id_unit'] 	= $id_unit;
		
		$this->template->load('template','tusbung_harian/v_index',$data);
	}
	
	
	public function perhari()
	{
		if (isset($_GET['id_unit'])) {
			$id_unit = $_GET['id_unit'];
		} else {
			$id_unit = 1;
			
		}
		
		if (isset($_GET['tgl_skrg'])) {
			$tgl_skrg = $_GET['tgl_skrg'];
		} else {
			$tgl_skrg = date("d");
			
			
		}
		
		$hari = date("l", strtotime($_SESSION['tahun_sess']."-".$_SESSION['bulan_sess']."-".$tgl_skrg));
		
		$data['app'] 	= "Billman SAYA";
		$data['title'] 	= "Monitoring Harian";
		$data['unit'] 		= $this->M_Unit->get_all();
		$data['tgl_skrg']   = $tgl_skrg;
		$data['hari']   	= $hari;
		$unit = $this->M_Unit->get_one($id_unit);
		foreach ($unit->result() as $r) {
			$data['nama_unit'] = $r->nama_unit;
		}
		
		$data['non_petugas'] 	= $this->M_Petugas->by_unit(0); // 0 = all 
		
		if ($id_unit == null) {
			$data['petugas'] 	= $this->M_Petugas->by_unit(1, 0); // 1 = manokwari
			
			//parameter kedua adalah isi dari is_petugas_khusus
			$data['petugas_khusus'] 	= $this->M_Petugas->by_unit(1, 1); // 1 = petugas khusus
			
			$data['id_unit'] 	= $id_unit;
		} else {
			$data['petugas'] 	= $this->M_Petugas->by_unit($id_unit, 0);
			$data['petugas_khusus'] 	= $this->M_Petugas->by_unit($id_unit, 1);
			$data['id_unit'] 	= $id_unit;
		}
		
		$this->template->load('template','tusbung_harian/v_perhari',$data);
	}
	
	
	public function hapus($id)
	{
		if (isset($_GET['tgl'])) {
			$tgl_skrg = $_GET['tgl'];
		} else {
			$tgl_skrg = date("d");
		}
		
		
		$cek = $this->M_Unit->get_one($id)->num_rows();
		if ($cek > 0) {
			$tusbung = $this->M_Tusbung_Harian->hapus($id, $tgl_skrg);
			$kendala_harian = $this->M_Kendala_Harian->hapus($tgl_skrg);
			$error = $this->db->error();
			if ($error['code'] == null) {
				$this->session->set_flashdata('success', "Data Tusbung Harian <b>Berhasil</b>  dihapus");
			} else {
				$this->session->set_flashdata('error', "Data Tusbung Harian <b>Gagal</b> dihapus. <br>Error:".$error['message']);
			}
			if ($id == 1) {
				redirect('tusbung_harian');
			} else {
				redirect('tusbung_harian?id_unit='.$id);
			}	
		} else {
			$this->session->set_flashdata('error', "Data Unit <b>$id</b> tidak ada.");
			echo "error";
			if ($id == 1) {
				redirect('tusbung_harian');
			} else {
				redirect('tusbung_harian?id_unit='.$id);
			}
		}		
	}
	
	
	public function update_lunas()
	{
		$data = array(
			'unit'	=>	$this->M_Unit->get_all(),
		);
		
		$this->template->load('template','tusbung_harian/v_update', $data);
	}
	
}

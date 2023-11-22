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
										$this->M_Tusbung->edit_petugas_khusus($edit, $id_pelanggan, $bulan, $tahun);	
										} else {
										//null kan id_petugas_khusus di tusbung_kumulatif 
										$edit = array('id_petugas_khusus'	=>null);
										$this->M_Tusbung->edit_petugas_khusus($edit, $id_pelanggan, $bulan, $tahun);	
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
						
						//update di tusbung kumulatif
						$lunas = $row['P'];
						if ($lunas == "lunas") {
							$is_lunas = 1;
						} else {
							$is_lunas = 0;
						}
						$edit = array('is_lunas'		 =>$is_lunas, 
									  'tgl_lunas' 		 => $tgl_tusbung,
									  'id_jenis_kendala' => $id_jenis_kendala);
						
						$this->M_Tusbung->edit_lunas($edit, $id_pelanggan, $bulan, $tahun);	
						//echo $lunas;
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
	
	public function back()
	{
		redirect("tusbung_harian/import"); 
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
		
		$data['app'] 	= "Billman SAYA";
		$data['title'] 	= "Monitoring Harian";
		$data['unit'] 		= $this->M_Unit->get_all();
		$data['tgl_skrg']   = $tgl_skrg;
		$data['hari']   	= $hari;
		$unit = $this->M_Unit->get_one($id_unit);
		foreach ($unit->result() as $r) {
			$data['nama_unit'] = $r->nama_unit;
		}
		
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
		
		$this->template->load('template','tusbung_harian/v_index',$data);
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

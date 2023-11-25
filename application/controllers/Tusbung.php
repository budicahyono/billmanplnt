<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

// Include librari PhpSpreadsheet
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	//use PhpOffice\PhpSpreadsheet\IOFactory;


class Tusbung extends CI_Controller {
	function __construct(){
				parent::__construct();
						
				$this->load->model('M_Admin');
				$this->load->model('M_Unit');
				$this->load->model('M_Rp_Kategori');
				$this->load->model('M_Pelanggan');
				$this->load->model('M_Petugas');
				$this->load->model('M_Tusbung');
				$this->load->model('M_Jenis_Kendala');
				is_login("yes");
				 
		}
		
	public function index()
	{
		if (isset($_GET['id_unit'])) {
			$id_unit = $_GET['id_unit'];
			if ($id_unit == 1) {
				redirect('tusbung');
			}
		} else {
			$id_unit = 1;
			
		}
		
		
		$data['unit'] 		= $this->M_Unit->get_all();
		$unit = $this->M_Unit->get_one($id_unit);
		foreach ($unit->result() as $r) {
			$data['nama_unit'] = $r->nama_unit;
		}
		
		$data['non_petugas'] 	= $this->M_Petugas->by_unit(0); // 0 = all 
		
		if ($id_unit == null) {
			$data['petugas'] 	= $this->M_Petugas->by_unit(1); // 1 = manokwari
			
			$data['id_unit'] 	= $id_unit;
		} else {
			$data['petugas'] 	= $this->M_Petugas->by_unit($id_unit);
			$data['id_unit'] 	= $id_unit;
		}
		
		
		$this->template->load('template','tusbung/v_index',$data);
	}
	
	public function petugas($id_petugas = null)
	{
		
		(isset($_GET['id_unit'])) 	? $id_unit = $_GET['id_unit'] 	: $id_unit = null;
		(isset($_GET['limit'])) 	? $limit = $_GET['limit'] 		: $limit = null;
		(isset($_GET['q'])) 		? $q = $_GET['q'] 				: $q = null;
		(isset($_GET['jenis'])) 	? $jenis = $_GET['jenis'] 		: $jenis = null;
		(isset($_GET['total'])) 	? $total = $_GET['total'] 		: $total = null;
		
		
		if ($total == null) {
			if ($jenis == "tul") {
				if ($q != null) {
					$tusbung = $this->M_Tusbung->get_tul_petugas($id_petugas, $id_unit, null, $q);
				} else {
					$tusbung = $this->M_Tusbung->get_tul_petugas($id_petugas, $id_unit, $limit, null);
				}
			} else if ($jenis == "lunas") {
				if ($q != null) {
					$tusbung = $this->M_Tusbung->get_tul_lunas($id_petugas, $id_unit, null, $q);
				} else {
					$tusbung = $this->M_Tusbung->get_tul_lunas($id_petugas, $id_unit, $limit, null);
				}
			} else {
				if ($q != null) {
					$tusbung = $this->M_Tusbung->get_tul_blm($id_petugas, $id_unit, null, $q);
				} else {
					$tusbung = $this->M_Tusbung->get_tul_blm($id_petugas, $id_unit, $limit, null);
				}
			}
		} else {	
			if ($jenis == "tul") {
				if ($q != null) {
					$tusbung = $this->M_Tusbung->get_by_unit($id_unit, null, $q);
				} else {
					$tusbung = $this->M_Tusbung->get_by_unit($id_unit, $limit, null);
				}
			} else if ($jenis == "lunas") {
				if ($q != null) {
					$tusbung = $this->M_Tusbung->get_lunas($id_unit, null, $q);
				} else {
					$tusbung = $this->M_Tusbung->get_lunas($id_unit, $limit, null);
				}
			} else {
				if ($q != null) {
					$tusbung = $this->M_Tusbung->get_blm($id_unit, null, $q);
				} else {
					$tusbung = $this->M_Tusbung->get_blm($id_unit, $limit, null);
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
					'rptag' 				=> 'Rp '.number_format($row->rptag),
					'rbk' 					=> $row->rbk,
					'is_lunas' 				=> $row->is_lunas,
					'tgl_lunas' 			=> $tgl_lunas,
					'nama_jenis_kendala' 	=> $row->nama_jenis_kendala,
				]);
		
		}
		
		
		echo json_encode($data);
	}
	
	public function search($id_petugas = null)
	{
		
		
		(isset($_GET['id_unit'])) 	? $id_unit = $_GET['id_unit'] 	: $id_unit = null;
		(isset($_GET['no'])) 	? 	$no_list = $_GET['no'] 			: $no_list = null;
		(isset($_GET['q'])) 		? $q = $_GET['q'] 				: $q = null;
		(isset($_GET['jenis'])) 	? $jenis = $_GET['jenis'] 		: $jenis = null;
		(isset($_GET['total'])) 	? $total = $_GET['total'] 		: $total = null;
		
		
		if ($q != null) {
			$limit = 10;
			if ($total == null) {	
				if ($jenis == "tul") {
					$tusbung = $this->M_Tusbung->get_tul_petugas($id_petugas, $id_unit, $limit, $q);
				} else if ($jenis == "lunas") {
					$tusbung = $this->M_Tusbung->get_tul_lunas($id_petugas, $id_unit, $limit, $q);
				} else {
					$tusbung = $this->M_Tusbung->get_tul_blm($id_petugas, $id_unit, $limit, $q);
				}
			} else {
				if ($jenis == "tul") {
					$tusbung = $this->M_Tusbung->get_by_unit($id_unit, $limit, $q);
				} else if ($jenis == "lunas") {
					$tusbung = $this->M_Tusbung->get_lunas($id_unit, $limit, $q);
				} else {
					$tusbung = $this->M_Tusbung->get_blm($id_unit, $limit, $q);
				}
			}	
			$data['no_list'] = $no_list;
			$data['id_petugas'] = $id_petugas;
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
					'rptag' 				=> 'Rp '.number_format($row->rptag),
					'rbk' 					=> $row->rbk,
					'is_lunas' 				=> $row->is_lunas,
					'tgl_lunas' 			=> $tgl_lunas,
					'bulan' 				=> bln_indo($row->bulan),
					'tahun' 				=> $row->tahun,
					'nama_jenis_kendala' 	=> $row->nama_jenis_kendala,
				]);
		
		}
		
		
		echo json_encode($data);
		
		
	}
	
	public function import()
	{
		$data = array(
			'unit'	=>	$this->M_Unit->get_all(),
		);
		$this->template->load('template','tusbung/v_import',$data);
	}
	
	public function cek($rptag)
	{
		$rp_kategori = $this->M_Rp_Kategori->cek($rptag);
		foreach ($rp_kategori->result() as $r) {
			echo "Rupiah yg dicari: ".number_format($rptag)."<br>";
		
			echo "id: ".$r->id_rp_kategori."<br>";
			echo "nama: ".$r->nama_rp_kategori."<br>";
			echo "range: ".$r->rp_bawah."-".$r->rp_atas."<br>";
		}
		
		//echo print_r($rp_kategori);
	}
	
	public function hasil_import()
	{	
		
		
		if(isset($_POST['submit'])){
			
			
			$namafile = "import_tusbung";
			
		
		
		
		
		
			$bulan   		 =  $_SESSION['bulan_sess'];
			$tahun   		 =  $_SESSION['tahun_sess'];
			$id_unit   		 =  $this->input->post('id_unit');
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
				$data_pelanggan = array(); 
				$duplikat_pelanggan = array(); 
				$data_tusbung = array(); 
				$duplikat_tusbung = array(); 
			   
			   
			   // Panggil class PHPExcel nya
				$spreadsheet = new  \PhpOffice\PhpSpreadsheet\Reader\Xlsx();    
				$loadexcel = $spreadsheet->load('import/'.$namafile.'.xlsx'); 
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);    
				       
				$numrow = 1;    
				foreach($sheet as $row){      
					if($numrow > 1){     
						
						$nama = $row['J'];
						$petugas = $this->M_Petugas->cek($nama);
						if ($petugas->num_rows() > 0) {
							foreach ($petugas->result() as $r) {
								$id_petugas = $r->id_petugas;
							}
						} else {
							$this->session->set_flashdata('error', "Tidak ada petugas dengan nama <b>$nama</b> pada data master");
							redirect("tusbung/import"); 
						}	
						
						//cek dulu idpelanggan di database
						$id_pelanggan = $row['A'];
						$pelanggan = $this->M_Pelanggan->cek($id_pelanggan)->num_rows();
						if ($pelanggan == 0) { // kalau kosong
							//input ke tabel pelanggan 
							array_push($data_pelanggan, [          
								'id_pelanggan' 		=>$row['A'],    
								'nama_pelanggan'    =>$row['B'],   
								'tarif'     		=>$row['C'], 
								'daya'     			=>$row['D'],   
								'gol'				=>$row['E'],  
								'alamat'			=>$row['F'],  
								'kddk'				=>$row['G'],  
								'no_hp'				=>$row['M'], 
								'is_new'			=>1, 
								'id_unit'			=>$id_unit,
							]); 
						} else { // kalau ada data masukkan dalam array duplikat
							array_push($duplikat_pelanggan, [          
								'id_pelanggan' 		=>$row['A'],    
								'nama_pelanggan'    =>$row['B'],   
								'tarif'     		=>$row['C'], 
								'daya'     			=>$row['D'],   
								'gol'				=>$row['E'],  
								'alamat'			=>$row['F'],  
								'kddk'				=>$row['G'],  
								'no_hp'				=>$row['M'], 
								'id_unit'			=>$id_unit,
							]); 
							//ubah data yg di database jadi 0 karena sudah bukan data baru
							//dan update data di pelanggan meskipun duplikat krn bisa saja ada perubahan data (misal: kddk salah ketik, alamat, dll)
							$data_edit =array('nama_pelanggan'  =>$row['B'],   
											  'tarif'     		=>$row['C'], 
											  'daya'     		=>$row['D'],   
											  'gol'				=>$row['E'],  
											  'alamat'			=>$row['F'],  
											  'kddk'			=>$row['G'],  
											  'no_hp'			=>$row['M'], 
											  'id_unit'			=>$id_unit,
											  'is_new'			=>0);
							
							$this->M_Pelanggan->edit($data_edit, $id_pelanggan);	
						}
						
						
						
						//input ke tabel tusbung 
						$rptag = $row['N'];
						$rp_kategori = $this->M_Rp_Kategori->cek($rptag);
						foreach ($rp_kategori->result() as $r) {
							$id_rp_kategori = $r->id_rp_kategori;
						}
						//cek di tusbung apakah sudah ada id_pelanggan, bulan dan tahun tersebut 
						$where = array(
							'id_pelanggan' => $id_pelanggan,
							'bulan' => $bulan,
							'tahun' => $tahun,
						);
						$cek_tusbung = $this->M_Tusbung->cek($where)->num_rows();
						if ($cek_tusbung == 0) {
							if ($row['O'] == "lunas") { 
								$is_lunas = 1;
							} else {
								$is_lunas = 0;
							}
							
							if (isset($row['P'])) { //cek jika kolom tanggal terisi
								if(strpos($row['P'], "'") !== false){ // cek jika ada single quote
									$ubah_tgl = str_replace("'","",$row['P']);
								} else {
									$ubah_tgl = $row['P'];
								}
								// cek jika kolom di isi tanggal sesuai format excel
								if (DateTime::createFromFormat("d/m/Y", $ubah_tgl) !== false) {
								  $ubah_lagi =  str_replace("/", "-", $ubah_tgl); //ubah / ke -
								  $tgl_lunas =  date("Y-m-d", strtotime($ubah_lagi)); //ubah ke format mysql
								} else {
								  $tgl_lunas = "0000-00-00";
								}
							} else { // jika kosong, input tanggal kosong dengan format mysql
								$tgl_lunas = "0000-00-00";
							}
						
							array_push($data_tusbung, [          
								'id_pelanggan' 		=>$row['A'],    
								'lbr'    			=>$row['L'],   
								'rptag'     		=>$rptag,   
								'rbk'     			=>0,
								'is_lunas'			=>$is_lunas,
								'tgl_lunas'			=>$tgl_lunas,
								'id_jenis_kendala'	=>0,  
								'id_rp_kategori'	=>$id_rp_kategori,  
								'bulan'				=>$bulan,  
								'tahun'				=>$tahun,  
								'id_petugas'		=>$id_petugas,
								'id_petugas_khusus'	=>null,
							]); 	
						} else {
							array_push($duplikat_tusbung, [          
								'id_pelanggan' 		=>$row['A'],    
								'lbr'    			=>$row['L'],   
								'rptag'     		=>$rptag, 
								'id_jenis_kendala'	=>0,  
								'id_rp_kategori'	=>$id_rp_kategori,  
								'bulan'				=>$bulan,  
								'tahun'				=>$tahun,  
								'id_petugas'		=>$id_petugas,
							]); 
						}	
						
					}            
					
					$numrow++;    
				} 
				
				
				
				
				$sum_pelanggan = count($data_pelanggan);
				$sum_tusbung = count($data_tusbung);
				$sum_duplikat = count($duplikat_pelanggan);
				$sum_tus_duplikat = count($duplikat_tusbung);
				//masukkan dalam proses query tapi dicek dulu jumlah array dalam data
				if ($sum_pelanggan > 0) {
					$this->M_Pelanggan->insert_multiple($data_pelanggan);  
				}
				if ($sum_tusbung > 0) {
					$this->M_Tusbung->insert_multiple($data_tusbung);  
				}	
				
				//cek jumlah data di database per unit 
				$cek_pelanggan = $this->M_Pelanggan->get_by_unit($id_unit)->num_rows();
				
				$total = $sum_pelanggan + $sum_duplikat;	
				
				
				
				
				
				
				
				
				$data = array(
					'app' => 'Billman SAYA',
					'title' => "Hasil Import Tusbung",
					'id_unit' => $id_unit,
					'nama_unit' => $nama_unit,
					'sum_pelanggan' => $sum_pelanggan,
					'sum_tusbung' => $sum_tusbung,
					'sum_duplikat' => $sum_duplikat,
					'sum_tus_duplikat' => $sum_tus_duplikat,
					'duplikat_pelanggan' => $duplikat_pelanggan,
					'duplikat_tusbung' => $duplikat_tusbung,
					'total' => $total,
				);
				
				
				
				$this->template->load('template','tusbung/v_hasil',$data);
				unlink("import/$namafile.xlsx");
				
			}else{ 
				$error =  $this->upload->display_errors();   
				$this->session->set_flashdata('error', "Data Tusbung <b>Gagal</b>  diimport. Error :" . $error);echo "gagal";
				redirect("tusbung/import"); 
			}  
			
			
			
		}	
	}
	
	public function back()
	{
		redirect("tusbung/import"); 
	}
	
	public function next()
	{
		if (isset($_GET['id_unit'])) {
			$id_unit = $_GET['id_unit'];
		} else {
			$id_unit = 1;
			
		}
		redirect("tusbung?id_unit=$id_unit"); 
	}
	
	public function hari_baca()
	{
		if (isset($_GET['id_unit'])) {
			$id_unit = $_GET['id_unit'];
		} else {
			$id_unit = 1;
			
		}
		
		$data['app'] 	= "Billman SAYA";
		$data['title'] 	= "Hari Baca Tusbung";
		$data['unit'] 		= $this->M_Unit->get_all();
		$data['non_petugas'] 	= $this->M_Petugas->by_unit(0); // 0 = all 
		
		if ($id_unit == null) {
			$data['petugas'] 	= $this->M_Petugas->by_unit(1); // 1 = manokwari
			
			$data['id_unit'] 	= $id_unit;
		} else {
			$data['petugas'] 	= $this->M_Petugas->by_unit($id_unit);
			$data['id_unit'] 	= $id_unit;
		}
		$this->template->load('template','tusbung/v_baca',$data);
	}
	
	public function rupiah_baca()
	{
		if (isset($_GET['id_unit'])) {
			$id_unit = $_GET['id_unit'];
		} else {
			$id_unit = 1;
			
		}
		
		
		$data['unit'] 		= $this->M_Unit->get_all();
		$data['non_petugas'] 	= $this->M_Petugas->by_unit(0); // 0 = all 
		
		if ($id_unit == null) {
			$data['petugas'] 	= $this->M_Petugas->by_unit(1); // 1 = manokwari
			
			$data['id_unit'] 	= $id_unit;
		} else {
			$data['petugas'] 	= $this->M_Petugas->by_unit($id_unit);
			$data['id_unit'] 	= $id_unit;
		}
		$this->template->load('template','tusbung/v_rp_baca',$data);
	}
	
	public function kendala()
	{
		if (isset($_GET['id_unit'])) {
			$id_unit = $_GET['id_unit'];
			if ($id_unit == 1) {
				redirect('tusbung');
			}
		} else {
			$id_unit = 1;
			
		}
		$data['id_unit'] 	= $id_unit;
		$data['unit'] 		= $this->M_Unit->get_all();
		$unit = $this->M_Unit->get_one($id_unit);
		foreach ($unit->result() as $r) {
			$data['nama_unit'] = $r->nama_unit;
		}
		$data['jenis_kendala'] 		= $this->M_Jenis_Kendala->get_all();
		
		
		$this->template->load('template','tusbung/v_kendala',$data);
	}
	
	
	
	
	
	public function hapus($id)
	{
		$cek = $this->M_Unit->get_one($id)->num_rows();
		if ($cek > 0) {
			$tusbung = $this->M_Tusbung->hapus($id);
			
			$error = $this->db->error();
			if ($error['code'] == null) {
				$this->session->set_flashdata('success', "Data Tusbung <b>Berhasil</b>  dihapus");
			} else {
				$this->session->set_flashdata('error', "Data Tusbung <b>Gagal</b> dihapus. <br>Error:".$error['message']);
			}
			if ($id == 1) {
				redirect('tusbung');
			} else {
				redirect('tusbung?id_unit='.$id);
			}	
		} else {
			$this->session->set_flashdata('error', "Data Unit <b>$id</b> tidak ada.");
			echo "error";
			if ($id == 1) {
				redirect('tusbung');
			} else {
				redirect('tusbung?id_unit='.$id);
			}
		}		
	}
	
}

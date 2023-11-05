<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

// Include librari PhpSpreadsheet
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	//use PhpOffice\PhpSpreadsheet\IOFactory;

class TusbungHarian extends CI_Controller {
	function __construct(){
				parent::__construct();
						
				$this->load->model('M_Admin');
				$this->load->model('M_Unit');
				$this->load->model('M_Petugas');
				$this->load->model('M_Pelanggan');
				$this->load->model('M_Tusbung');
				$this->load->model('M_Jenis_Kendala');
				$this->load->model('M_Tusbungharian');
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
				
				
				 function bln_indo($date)
				{
					$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
				 
					
					$bulan = $date;
					 
				 
					$result =   $BulanIndo[(int)$bulan-1] ;		
					return($result);
				} 
		}
		
	
	
	
	
	
	public function import()
	{
		$data = array(
			'app' => 'Billman PLN-T',
			'title' => "Tusbung Harian",
			'unit'	=>	$this->M_Unit->get_all(),
		);
		$this->template->load('template','tusbung_harian/v_import',$data);
	}
	
	public function post()
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
						} else {
							//$this->session->set_flashdata('error', "Tidak ada jenis kendala dengan nama <b>$kendala</b> pada data master");
							//redirect("tusbungharian/import"); 
							$id_jenis_kendala = 0;
						}	
						
						
						
						
						//cek dulu idpelanggan dan tanggal yg sama
						$id_pelanggan = $row['A'];
						$pelanggan_harian = $this->M_Tusbungharian->cek($id_pelanggan, $tgl_tusbung)->num_rows();
						
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
						
								//input ke tabel tusbung_harian 
								array_push($tusbung_harian, [          
									'id_pelanggan' 		=>$id_pelanggan,    
									'tgl_tusbung'    	=>$tgl_tusbung,   
									'is_evidence'     	=>$row['L'], 
									'id_jenis_kendala'  =>$id_jenis_kendala
								]); 
							} else {
								if ($pelanggan == 0 && $tusbung == 0) {
									$this->session->set_flashdata('error', "Tidak ada data pelanggan dengan ID <b>$id_pelanggan</b> maupun di tusbung kumulatif pada bulan <b>$bulan</b> dan tahun <b>$tahun</b>");
								}
								if ($tusbung == 0) {
									$this->session->set_flashdata('error', "Tidak ada data tusbung kumulatif dengan ID pelanggan <b>$id_pelanggan</b> pada bulan <b>$bulan</b> dan tahun <b>$tahun</b>");
								}
								redirect("tusbungharian/import"); 
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
								'is_evidence'     	=>$row['L'], 
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
						$this->M_Tusbung->edit(array('is_lunas'	=>$is_lunas, 'tgl_lunas' => $tgl_tusbung), $id_pelanggan);	
						
					}            
					
					$numrow++;    
				} 
				
				
				$sum_tusbung_harian = count($tusbung_harian);
				$sum_duplikat = count($duplikat_pelanggan);
				//masukkan dalam proses query tapi dicek dulu jumlah array dalam data
				if ($sum_tusbung_harian > 0) {
					$this->M_Tusbungharian->insert_multiple($tusbung_harian);  
				}
				$total = $sum_tusbung_harian + $sum_duplikat;	
				
				
				if (count($duplikat_pelanggan) > 100 ) { 
					$this->session->set_flashdata('error', "Terlalu banyak data Tusbung Harian yang <b>Duplikat</b>");
					redirect("tusbungharian/import"); 
				}
				
				if ($sum_duplikat > 0 ) { 
					$this->session->set_flashdata('error', "Data Tusbung Harian ada yang <b>Duplikat</b>!! gagal diimport");
				} else {
					$this->session->set_flashdata('success', "Data Tusbung Harian <b>Berhasil</b>  diimport");
				}
				
				$data = array(
					'app' => 'Billman PLN-T',
					'title' => "Hasil Import Tusbung Harian $nama_unit",
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
				redirect("tusbungharian/import"); 
			}  
			
			
			
		}	
	}
	
	public function back()
	{
		redirect("tusbungharian/import"); 
	}
	
	public function next()
	{
		if (isset($_GET['id_unit'])) {
			$id_unit = $_GET['id_unit'];
		} else {
			$id_unit = 1;
			
		}
		redirect("tusbungharian?id_unit=$id_unit"); 
	}
	
	
	public function index()
	{
		$data = array(
			'app' => 'Billman PLN-T',
			'title' => "Update Kendala",
		);
		$this->template->load('template','tusbung_harian/v_index',$data);
	}
	
	
	
	
}

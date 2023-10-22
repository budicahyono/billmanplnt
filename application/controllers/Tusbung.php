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
		
	public function index()
	{
		$data = array(
			'app' => 'Billman PLN-T',
			'title' => ucfirst($this->uri->segment(1)),
		);
		$this->template->load('template','tusbung/v_index',$data);
	}
	
	public function import()
	{
		$data = array(
			'app' => 'Billman PLN-T',
			'title' => "Import Tusbung",
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
	
	public function post()
	{	
		
		
		if(isset($_POST['submit'])){
			
			
			$namafile = "import_tusbung";
			
		
		
		
		
		
			$bulan   		 =  $_SESSION['bulan_sess'];
			$tahun   		 =  $_SESSION['tahun_sess'];
			$id_unit   		 =  $this->input->post('id_unit');
			
			
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
						foreach ($petugas->result() as $r) {
							$id_petugas = $r->id_petugas;
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
								'id_petugas'		=>$id_petugas,
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
								'id_petugas'		=>$id_petugas,
							]); 
							//ubah data yg di database jadi 0 karena sudah bukan data baru
							$this->M_Pelanggan->edit(array('is_new'	=>0), $id_pelanggan);	
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
				
				
				
				
				if (count($duplikat_pelanggan) > 100 && count($duplikat_tusbung) > 100) { 
					$this->session->set_flashdata('error', "Terlalu banyak Data pelanggan dan tusbung yang <b>Duplikat</b>");
					redirect("tusbung/import"); 
				}
				
				$this->session->set_flashdata('success', "Data Tusbung <b>Berhasil</b>  diimport");	
				//redirect("tusbung"); 
				$data = array(
					'app' => 'Billman PLN-T',
					'title' => "Hasil Import Tusbung",
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
	
	public function jadwal()
	{
		$data = array(
			'app' => 'Billman PLN-T',
			'title' => "Jadwal Tusbung",
		);
		$this->template->load('template','tusbung/v_jadwal',$data);
	}
	
	public function kendala()
	{
		$data = array(
			'app' => 'Billman PLN-T',
			'title' => "Kendala",
		);
		$this->template->load('template','tusbung/v_kendala',$data);
	}
	
	
	public function excel()
    {
        
		
		
		 // Panggil class PHPExcel nya
		    $spreadsheet = new Spreadsheet();    
			$sheet = $spreadsheet->getActiveSheet();
		
		$nama_File = "Coba.xlsx";
        $judul = "Coba";
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		
		
		 $sheet->setCellValue('A1', $judul); // Set kolom A1 dengan tulisan "DATA SISWA"
		
    // Set orientasi kertas jadi LANDSCAPE
    $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

    // Set judul file excel nya
    $sheet->setTitle($judul);

    // Proses file excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="'.$nama_File.'"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
		
		
    }
	
}

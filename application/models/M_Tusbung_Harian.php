<?php
	class M_Tusbung_Harian extends CI_Model	{
		var $tb = "tusbung_harian";
		var $id = "id_tusbung_harian";
		
		
		function cek($id_pelanggan, $tgl_tusbung)
		{	// ambil semua data pelanggan per unit 
			$this->db->where("id_pelanggan", $id_pelanggan);
			$this->db->where("tgl_tusbung", $tgl_tusbung);
			return $this->db->get($this->tb);
		}
		
		
		
		function by_unit($id, $id_unit, $tgl, $khusus = null) 
		{	// ambil data petugas per unit 
			$this->db->where("id_unit", $id);
			if ($khusus == null) {
				$this->db->where("is_petugas_khusus", 0);
			} else {
				$this->db->where("is_petugas_khusus", $khusus);
			}
			$petugas = $this->db->get('petugas')->result_array();
			
			//setiap foreach masukkan method get_tul dengan parameter masing2
			foreach ($petugas as &$r) {
				$id = $r['id_petugas'];
				$j 	= 'tul';
				$l 	= 'lunas';
				if ($khusus == null) {
					$opsi_tul 			= ['id_petugas' => $id,'id_unit' => $id_unit,'opsi' => 'sum','jenis' => $j,'tgl' => $tgl];
					$opsi_rp 			= ['id_petugas' => $id,'id_unit' => $id_unit,'opsi' => 'rp','jenis' => $j,'tgl' => $tgl];
					$opsi_lunas 		= ['id_petugas' => $id,'id_unit' => $id_unit,'opsi' => 'sum','jenis' => $l,'tgl' => $tgl];
					$opsi_lunas_rp 		= ['id_petugas' => $id,'id_unit' => $id_unit,'opsi' => 'rp','jenis' => $l,'tgl' => $tgl];
					$opsi_evi 			= ['id_petugas' => $id,'id_unit' => $id_unit,'opsi' => 'sum','evidence' => true,'tgl' => $tgl];
				} else {
					$r['text_khusus'] 	= "(Petugas Khusus)";
					$khusus 			= $r['id_petugas'];
					$opsi_tul 			= ['khusus' => $khusus,'id_unit' => $id_unit,'opsi' => 'sum','jenis' => $j,'tgl' => $tgl];
					$opsi_rp 			= ['khusus' => $khusus,'id_unit' => $id_unit,'opsi' => 'rp','jenis' => $j,'tgl' => $tgl];
					$opsi_lunas 		= ['khusus' => $khusus,'id_unit' => $id_unit,'opsi' => 'sum','jenis' => $l,'tgl' => $tgl];
					$opsi_lunas_rp 		= ['khusus' => $khusus,'id_unit' => $id_unit,'opsi' => 'rp','jenis' => $l,'tgl' => $tgl];
					$opsi_evi 			= ['khusus' => $khusus,'id_unit' => $id_unit,'opsi' => 'sum','evidence' => true,'tgl' => $tgl];
				}
				$r['sum_tul'] 		= $this->get_tul($opsi_tul)->num_rows();
				$r['sum_tul_rp']	= $this->get_tul($opsi_rp);
				$r['sum_lunas'] 	= $this->get_tul($opsi_lunas)->num_rows();
				$r['sum_lunas_rp'] 	= $this->get_tul($opsi_lunas_rp);
				$r['sum_evidence'] 	= $this->get_tul($opsi_evi)->num_rows();
				
				$opsi_kendala		= ['id_petugas' => $id, 'tgl' => $tgl];
				$kendala_harian 	= $this->get_kendala_harian($opsi_kendala);
				if ($kendala_harian->num_rows() > 0) {
                      foreach ($kendala_harian->result() as $row) {
                          $r['isi_kendala'] 		= $row->isi_kendala;
                          $r['id_kendala_harian'] 	= $row->id_kendala_harian;
                          $r['text_kendala'] 		= $row->isi_kendala;
                          
                      } 
				} else {
					$r['isi_kendala'] 		= null;
					$r['id_kendala_harian'] = null;
					$r['text_kendala'] 		= "<i style='color:red'>Belum diisi</i>";
				}  
				
				//realisasi pelanggan / tul yg lunas
				if ($r['sum_tul']  != 0 && $r['sum_lunas'] != 0) {
					$r['persen_tul']  = round($r['sum_lunas'] / $r['sum_tul'] * 100, 1);
					} else {
					$r['persen_tul'] = 0;
				}
				
				//realisasi rupiah yg lunas
				if ($r['sum_tul_rp']  != 0 && $r['sum_lunas_rp'] != 0) {
					$r['persen_tul_rp']  = round($r['sum_lunas_rp'] / $r['sum_tul_rp'] * 100, 1);
					} else {
					$r['persen_tul_rp'] = 0;
				}
				
				//realisasi evidence
				if ($r['sum_tul']  != 0 && $r['sum_evidence'] != 0) {
					$r['persen_evidence']  = round($r['sum_evidence'] / $r['sum_tul'] * 100, 1);
					} else {
					$r['persen_evidence'] = 0;
				}
				
				$r['sisa_evidence'] = $r['sum_tul']-$r['sum_evidence'];
			}
			
			return $petugas;
		}
		
		
		
		function get_tul($options = array()) 
		{	// ambil semua data tusbung per unit 
			// deklarasi parameter array menjadi variabel
			$id_petugas = isset($options['id_petugas']) ? $options['id_petugas'] : null;
			$id_unit 	= isset($options['id_unit']) ? $options['id_unit'] : null;
			$opsi 		= isset($options['opsi']) ? $options['opsi'] : null;
			$jenis 		= isset($options['jenis']) ? $options['jenis'] : null;
			$limit 		= isset($options['limit']) ? $options['limit'] : null;
			$q 			= isset($options['q']) ? $options['q'] : null;
			$khusus		= isset($options['khusus']) ? $options['khusus'] : null;
			$tgl		= isset($options['tgl']) ? $options['tgl'] : null;
			$evidence	= isset($options['evidence']) ? $options['evidence'] : null;
			$tgl_opsi	= isset($options['tgl_opsi']) ? $options['tgl_opsi'] : null;
			
			//gabungin tanggal
			$tanggal = $_SESSION['tahun_sess']."-".$_SESSION['bulan_sess']."-".$tgl;
			
			// jika parameter rp / rupiah
			if ($opsi == "rp") {
				$this->db->select_sum('tusbung_kumulatif.rptag');
			} 
			
			// join ke beberapa tabel
			$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_harian.id_pelanggan');
			$this->db->join('jenis_kendala', 'jenis_kendala.id_jenis_kendala = tusbung_harian.id_jenis_kendala');
			$this->db->join('tusbung_kumulatif', 'tusbung_kumulatif.id_pelanggan = tusbung_harian.id_pelanggan');
			
			// jika parameter petugas khusus ada
			if ($khusus != null) {
				$this->db->join('petugas pk', 'pk.id_petugas = tusbung_kumulatif.id_petugas_khusus');
				} else {
				$this->db->join('petugas p', 'p.id_petugas = tusbung_kumulatif.id_petugas');
			}
			
			// jika ada parameter limit
			if ($limit != null) {
				$this->db->limit($limit);
			}
			
			// jika ada parameter q / pencarian
			if ($q != null ) {
				$this->db->where("(tusbung_kumulatif.id_pelanggan LIKE '%".$q."%' OR pelanggan.nama_pelanggan LIKE '%".$q."%')");
			}
			
			if ($khusus == null) {
				if ($tgl_opsi == null ) {	
					$this->db->where("tusbung_kumulatif.id_petugas_khusus", null);
				}
				// jika ada parameter id_petugas
				if ($id_petugas != null ) {	
					$this->db->where("tusbung_kumulatif.id_petugas", $id_petugas);
				}
			} else {
				$this->db->where("tusbung_kumulatif.id_petugas_khusus", $khusus);
			}
			
			// pilih parameter jenis 
			if ($evidence != null) {
				$this->db->where("is_evidence", 1);
			} else {
				if ($jenis == "lunas") {
					$this->db->where("is_lunas", 1);
				} else if ($jenis == "blm") {
					$this->db->where("is_lunas", 0);
				} 
			}
			
			// pilih id_unit 
			//$this->db->where("pelanggan.id_unit", $id_unit);
			
			// pilih session bulan dan tahun 
			$this->db->where("bulan", $_SESSION['bulan_sess']);
			$this->db->where("tahun", $_SESSION['tahun_sess']);	
			
			// pilih tgl yang sudah digabung
			$this->db->where("tgl_tusbung", $tanggal);
			
			// jika parameter opsi = rp / rupiah
			if ($opsi == "rp") {
				$sum_rp = $this->db->get($this->tb)->result();
				foreach ($sum_rp as  $row) {
					return $row->rptag;
				}
				// jika parameter opsi = sum		
				} else {
				return $this->db->get($this->tb);
			}	
		}
		
		
		function get_kendala_harian($options = array()) 
		{	// ambil kendala_harian by id_petugas
			// deklarasi parameter array menjadi variabel
			$tgl 		= isset($options['tgl']) ? $options['tgl'] : null;
			$id_petugas = isset($options['id_petugas']) ? $options['id_petugas'] : null;
			$khusus 	= isset($options['khusus']) ? $options['khusus'] : null;
			
			$tanggal = $_SESSION['tahun_sess']."-".$_SESSION['bulan_sess']."-".$tgl;
			
			if ($khusus == null) {
				$this->db->where("id_petugas", $id_petugas);
				} else {
				$this->db->where("id_petugas", $khusus);
			}
			$this->db->where("tgl_kendala", $tanggal);
			return $this->db->get('kendala_harian');
		}
		
		
		
		// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data  
		function insert_multiple($data)
		{    
			$this->db->insert_batch($this->tb, $data);  
		}
		
		
		
		function hapus($key, $tgl) // hapus data tusbung
		{
			$this->db->query("DELETE ".$this->tb." FROM ".$this->tb." 
			JOIN tusbung_kumulatif ON tusbung_kumulatif.id_pelanggan = tusbung_harian.id_pelanggan 
			JOIN pelanggan ON pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan
			WHERE pelanggan.id_unit = '$key' 
			AND tgl_tusbung = '".$_SESSION['tahun_sess']."-".$_SESSION['bulan_sess']."-".$tgl."' ");
		}
		
		
		
	}		
<?php
	class M_Tusbung extends CI_Model	{
		var $tb = "tusbung_kumulatif";
		var $id = "id_tusbung_kumulatif";
	
		
		
		function get_by_idpel($id_pelanggan) 
		{	// ambil semua data tusbung per id_pelanggan
			$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
			$this->db->join('petugas', 'petugas.id_petugas = tusbung_kumulatif.id_petugas');
			$this->db->join('jenis_kendala jk', 'jk.id_jenis_kendala = tusbung_kumulatif.id_jenis_kendala');
			$this->db->where("pelanggan.id_pelanggan", $id_pelanggan);
			return $this->db->get($this->tb);
		}
		
		
		
		function all_unit() 
		{	// ambil semua data unit
			$unit = $this->db->get('unit')->result_array();
			
			//setiap foreach masukkan method get_by_unit dengan parameter masing2
			foreach ($unit as &$r) {
				$id = $r['id_unit'];
				$opsi_tul 		= ['id_unit' => $id,'opsi' => 'sum','jenis' => 'tul'];
				$r['total_tul'] = $this->get_tul($opsi_tul)->num_rows();
			}
			
			return $unit;
		}
		
		
		
		function by_unit($id, $id_unit) 
		{	// ambil data petugas per unit 
			$this->db->where("id_unit", $id);
			$petugas = $this->db->get('petugas')->result_array();
			
			//setiap foreach masukkan method get_tul dengan parameter masing2
			foreach ($petugas as &$r) {
				$id = $r['id_petugas'];
				$opsi_tul 			= ['id_petugas' => $id,'id_unit' => $id_unit,'opsi' => 'sum','jenis' => 'tul'];
				$r['sum_tul'] 		= $this->get_tul($opsi_tul)->num_rows();
				
				$opsi_rp 			= ['id_petugas' => $id,'id_unit' => $id_unit,'opsi' => 'rp','jenis' => 'tul'];
				$r['sum_tul_rp']	= $this->get_tul($opsi_rp);
				
				$opsi_lunas 		= ['id_petugas' => $id,'id_unit' => $id_unit,'opsi' => 'sum','jenis' => 'lunas'];
				$r['sum_lunas'] 	= $this->get_tul($opsi_lunas)->num_rows();
				
				$opsi_lunas_rp 		= ['id_petugas' => $id,'id_unit' => $id_unit,'opsi' => 'rp','jenis' => 'lunas'];
				$r['sum_lunas_rp'] 	= $this->get_tul($opsi_lunas_rp);
				
				$opsi_blm 			= ['id_petugas' => $id,'id_unit' => $id_unit,'opsi' => 'sum','jenis' => 'blm'];
				$r['sum_blm'] 		= $this->get_tul($opsi_blm)->num_rows();
				
				$opsi_blm_rp 		= ['id_petugas' => $id,'id_unit' => $id_unit,'opsi' => 'rp','jenis' => 'blm'];
				$r['sum_blm_rp']	= $this->get_tul($opsi_blm_rp);
				
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
			}
			
			return $petugas;
		}
		
		
		
		function baca_unit($id, $id_unit, $opsi) 
		{	// ambil data petugas per unit 
			$this->db->where("id_unit", $id);
			$petugas = $this->db->get('petugas')->result_array();
			
			//setiap foreach masukkan method get_tul dengan parameter masing2
			foreach ($petugas as &$r) {
				$id= $r['id_petugas'];
				$j = 'blm';
				$opsi_A 			= ['id_petugas' => $id,'id_unit' => $id_unit,'opsi' => $opsi,'jenis' => $j,'baca' => "A"];
				$r['sum_A'] 		= $this->get_tul($opsi_A);
				
				$opsi_B 			= ['id_petugas' => $id,'id_unit' => $id_unit,'opsi' => $opsi,'jenis' => $j,'baca' => "B"];
				$r['sum_B'] 		= $this->get_tul($opsi_B);
				
				$opsi_C 			= ['id_petugas' => $id,'id_unit' => $id_unit,'opsi' => $opsi,'jenis' => $j,'baca' => "C"];
				$r['sum_C'] 		= $this->get_tul($opsi_C);
				
				$opsi_D 			= ['id_petugas' => $id,'id_unit' => $id_unit,'opsi' => $opsi,'jenis' => $j,'baca' => "D"];
				$r['sum_D'] 		= $this->get_tul($opsi_D);
				
				$opsi_E 			= ['id_petugas' => $id,'id_unit' => $id_unit,'opsi' => $opsi,'jenis' => $j,'baca' => "E"];
				$r['sum_E'] 		= $this->get_tul($opsi_E);
				
				$opsi_F 			= ['id_petugas' => $id,'id_unit' => $id_unit,'opsi' => $opsi,'jenis' => $j,'baca' => "F"];
				$r['sum_F'] 		= $this->get_tul($opsi_F);
				
				$opsi_G 			= ['id_petugas' => $id,'id_unit' => $id_unit,'opsi' => $opsi,'jenis' => $j,'baca' => "G"];
				$r['sum_G'] 		= $this->get_tul($opsi_G);
				
				$opsi_H 			= ['id_petugas' => $id,'id_unit' => $id_unit,'opsi' => $opsi,'jenis' => $j,'baca' => "H"];
				$r['sum_H'] 		= $this->get_tul($opsi_H);
				
				$opsi_I 			= ['id_petugas' => $id,'id_unit' => $id_unit,'opsi' => $opsi,'jenis' => $j,'baca' => "I"];
				$r['sum_I'] 		= $this->get_tul($opsi_I);
			}
			
			return $petugas;
		}
		
		
		
		function by_kendala($id_unit) 
		{	// ambil semua data jenis_kendala
			$jenis_kendala = $this->db->get('jenis_kendala')->result_array();
			
			//setiap foreach masukkan method get_tul dengan parameter masing2
			foreach ($jenis_kendala as &$r) {
				$id = $r['id_jenis_kendala'];
				$op = 'sum';
				$j 	= 'blm';
				$opsi_tul 		= ['id_unit' => $id_unit,'opsi' => $op,'jenis' => $j,'kendala' => $id];
				$r['sum_tul'] 	= $this->get_tul($opsi_tul)->num_rows();
				
				$op = 'rp';
				$opsi_rp 		= ['id_unit' => $id_unit,'opsi' => $op,'jenis' => $j,'kendala' => $id];
				$r['sum_rp']	= $this->get_tul($opsi_rp);
				
				
			}
			
			return $jenis_kendala;
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
			$baca 		= isset($options['baca']) ? $options['baca'] : null;
			$kendala	= isset($options['kendala']) ? $options['kendala'] : null;
			
			// jika parameter rp / rupiah
			if ($opsi == "rp") {
				$this->db->select_sum('rptag');
			} 
			
			// join ke beberapa tabel
			$this->db->join('pelanggan', 'pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan');
			$this->db->join('jenis_kendala jk', 'jk.id_jenis_kendala = tusbung_kumulatif.id_jenis_kendala');
			$this->db->join('petugas', 'petugas.id_petugas = tusbung_kumulatif.id_petugas');
			
			// jika ada parameter limit
			if ($limit != null) {
				$this->db->limit($limit);
			}
			
			// jika ada parameter q / pencarian
			if ($q != null ) {
				$this->db->where("(tusbung_kumulatif.id_pelanggan LIKE '%".$q."%' OR pelanggan.nama_pelanggan LIKE '%".$q."%')");
			}
			
			// pilih parameter jenis 
			if ($jenis == "lunas") {
				$this->db->where("is_lunas", 1);
			} else if ($jenis == "blm") {
				$this->db->where("is_lunas", 0);
			} 
			
			// jika ada parameter id_petugas
			if ($id_petugas != null ) {	
				$this->db->where("tusbung_kumulatif.id_petugas", $id_petugas);
			}
			
			// jika ada parameter kendala
			if ($kendala != null) {
				$this->db->where("tusbung_kumulatif.id_jenis_kendala", $kendala);
			}
			
			// pilih id_unit 
			$this->db->where("pelanggan.id_unit", $id_unit);
			
			// jika ada parameter baca
			if ($baca != null) {
				$this->db->where("SUBSTRING(kddk, 7, 1) = '$baca'");
			}
			
			// pilih session bulan dan tahun 
			$this->db->where("bulan", $_SESSION['bulan_sess']);
			$this->db->where("tahun", $_SESSION['tahun_sess']);
			
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
		
		
		
		function cek($where)
		{	//cek di tusbung apakah sudah ada id_pelanggan, bulan dan tahun tersebut 
			return $this->db->get_where($this->tb,$where);
		}
		
		
		
		function insert_multiple($data)
		{   // insert lebih dari 1 data tusbung 
			$this->db->insert_batch($this->tb, $data);  
		}
		
		
		
		function edit($data, $key)
		{	// edit satu data tusbung
			$this->db->where($this->id, $key);
			$this->db->update($this->tb, $data);
		}
		
		
		
		function edit_by_bln_thn($data, $id_pelanggan, $bulan, $tahun)
		{	// edit data jadi lunas
			$this->db->where("id_pelanggan", $id_pelanggan);
			$this->db->where("bulan", $bulan);
			$this->db->where("tahun", $tahun);
			$this->db->update($this->tb, $data);
		}
		
		
		
		function hapus($key) 
		{	// hapus data tusbung
			$this->db->query("DELETE ".$this->tb." FROM ".$this->tb." 
			JOIN pelanggan ON pelanggan.id_pelanggan = tusbung_kumulatif.id_pelanggan 
			WHERE pelanggan.id_unit = '$key' 
			AND bulan = '".$_SESSION['bulan_sess']."' 
			AND tahun = '".$_SESSION['tahun_sess']."' ");
		}
		
		
		
	}			
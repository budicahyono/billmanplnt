<?php
	if (!defined('BASEPATH'))
	exit('No direct script access allowed');



	function myapp($item = "") 
	{	// informasi aplikasi
		$ci =& get_instance();
	
		$myapp = "";
		switch ($item) {
		  case "app_name":
			$myapp = "BILLMAN SAYA";
			break;
		  case "front_name":
			$myapp = "SITU - BILLMAN SAYA";
			break;	
		  case "dev_name":
			$myapp = "Tim Developer";
			break;	
		  case "link_dev":
			$myapp = "https://budikreatif.id/";	
			break;
		   case "office_name":
			$myapp = "PLN Nusa Daya UP3 Manokwari";
			break;	
		  case "version":
			$myapp = "1.0.0";
			break;
		  case "kop_laporan":
			$myapp = "img/kop.jpg";
			break;	
		  case "icon":
			$myapp = "img/icon.png";
			break;	
		  case "logo":
			$myapp = "img/Logo2.png";	
			break;		
		  default:
			echo "Myapp config tidak ada!";
		}	
		
		return $myapp;
	}
	
	
	
	function menu($child = null) 
	{	// informasi menu dan laman
		$ci =& get_instance();
		$menu = "";
		if ($child != null) {
			if ($ci->uri->segment(2) == TRUE) {
				$spasi1 = str_replace("_"," ", $ci->uri->segment(1));
				$spasi2 = str_replace("_"," ", $ci->uri->segment(2));
				$menu = ucwords( $spasi2  . " " .$spasi1);
			} else {
				$spasi1 = str_replace("_"," ", $ci->uri->segment(1));
				$menu = ucwords($spasi1);
			}
		} else {
			$spasi1 = str_replace("_"," ", $ci->uri->segment(1));
			$menu = ucwords($spasi1);
		}	
		return $menu;
	}
	
	
	
	function tgl_indo($date)
	{	// tgl and jam indo
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		
		$tahun = substr($date, 0, 4);
		$bulan = substr($date, 5, 2);
		$tgl   = substr($date, 8, 2);
		$j   = substr($date, 11, 2);
		$m   = substr($date, 14, 2);
		$d   = substr($date, 17, 2);
		
		$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun. " " . $j.":".$m.":".$d ;	
		return $result;
	}
	
	
	
	function tgl($date)
	{	// tgl indo
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		
		$tahun = substr($date, 0, 4);
		$bulan = substr($date, 5, 2);
		$tgl   = substr($date, 8, 2);
		
		
		$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun ;	
		return $result;
	}
	
	
	
	function bln_indo($date)
	{	// bln indo
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	 
		
		$bulan = $date;
		 
	 
		$result =   $BulanIndo[(int)$bulan-1] ;		
		return($result);
	}
	
	
	
	function hari($day) 
	{	//hari inggris ubah ke indo	
		switch ($day) {
		  case "Monday":
			$hari = "Senin";
			break;
		  case "Tuesday":
			$hari = "Selasa";
			break;
		  case "Wednesday":
			$hari = "Rabu";
			break;
		  case "Thursday":
			$hari = "Kamis";
			break;
		  case "Friday":
			$hari = "Jumat";
			break;	
		  case "Saturday":
			$hari = "Sabtu";
			break;	
		  case "Sunday":
			$hari = "Minggu";
			break;		
		  default:
			echo "Hari Kiamat";
		}
		return($hari);
	} 
	
	
	
	function human_readable_to_bytes(string $amount): int 
	{	// human_readable_to_bytes
		$units = ['', 'K', 'M', 'G'];
		
		preg_match('/(\d+)\s?([KMG]?)/', $amount, $matches);
		[$_, $nr, $unit] = $matches;
		$exp = array_search($unit, $units);
		return (int)$nr * 1024; //mb = 40mb, kb=40.000
	} 
	
	
	
	function is_login($status = "")
	{	// is_login
		$ci =& get_instance();
		$ci->load->model('M_Admin');
	
		if ($status == "yes") {
			if (!$ci->M_Admin->is_login()) { // jika belum login (tanda ! didepan) maka dilempar ke halaman awal
				redirect(".");		
			} 
		} else {
			if ($ci->M_Admin->is_login()) { // jika sudah login maka dilempar ke halaman dashboard
				redirect("dashboard");		
			}
		}
		
	} 
	
	
	
	function check_level($level)
	{	// check_level	
		if ($level != $_SESSION['level']) {
				redirect("dashboard");			
		} 
	} 
	
	
	
	function rp($value)
	{	// rupiah number_format	
		return "Rp ".number_format($value);
	} 
	
	
	
	
	
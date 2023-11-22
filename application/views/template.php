<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=myapp('app_name')?> | <?=menu()?></title>
  <link rel="icon" href="<?=base_url(myapp('icon'));?>">	
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url();?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?=base_url();?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url();?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?=base_url();?>plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url();?>dist/css/adminlte.css?v=<?php echo time() ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?=base_url();?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?=base_url();?>plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?=base_url();?>plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url();?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url();?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url();?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="<?=base_url();?>plugins/dropzone/min/dropzone.min.css">
  <!-- jquery-ui -->
 <link rel="stylesheet" href="<?=base_url();?>plugins/jquery-ui-1.13.2/jquery-ui.css">


</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?=base_url(myapp('icon'));?>" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
        <!-- bulan tahun Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" id="bulan_tahun" href="#">
          <i class="fas fa-calendar mr-2"></i>Pilih: <?=bln_indo($_SESSION['bulan_sess'])?> <?=$_SESSION['tahun_sess']?>
          
        </a>
        
		
		<div id="bulan_tahun_open" class="dropdown-menu dropdown-menu-lg dropdown-menu-right " style="left: inherit; right: 0px; ">
          <div class="form-group col-lg-12">
                    <label>Bulan</label>
                    <br/>
                    <select name="bulan" id="bulan_form" class="form-control"  >
                    <option value="">--Pilih Bulan--</option>
                      <?php
                      $bln_skrg = $_SESSION['bulan_sess'];
                     $jumlah_bulan = 12;
                      for ($i=1;$i<=$jumlah_bulan;$i++){
                        if ($bln_skrg == $i) {
                          echo '<option value="'.$i.'" selected>'.bln_indo($i).'</option>';
                        } else {
                          echo '<option value="'.$i.'">'.bln_indo($i).'</option>';
                        }
                      }
                      ?>
                    </select>
          </div>
          <div class="form-group col-lg-12">
                    <label>Tahun</label>
                    <br/>
                    <select name="tahun" id="tahun_form" class="form-control" >
                    <option value="">--Pilih tahun--</option>
                      <?php
                      $thn_awal = 2022;
                      $thn_skrg = $_SESSION['tahun_sess'];
                      $jumlah_thn = 3;
                      $selisih = $thn_skrg - $thn_awal;
                      $tambah = $selisih + $thn_awal + $jumlah_thn;
                      for ($i=$thn_awal;$i<=$tambah;$i++){
                        if ($thn_skrg == $i) {
                           echo '<option value="'.$i.'" selected>'.$i.'</option>';
                        } else {
                           echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                      }
                      ?>
                    </select>
          </div>
          <div class="form-group col-lg-12">
                  <input id="url_form" value="<?=current_url()?>" type="hidden">
                  <button id="submit_form"  class="btn btn-primary btn-block "><i class="fa fa-check"></i> Pilih</button>
          </div>
        </div>
      </li>
      <!-- bulan tahun End -->
      
      
      <!-- Account Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user mr-2"></i> <?=$_SESSION['nama_admin']?>
          
        </a>
        
		
		<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right " style="left: inherit; right: 0px;">
          
          
          <div class="dropdown-divider"></div>
          <a href="<?=base_url();?>profil/ubah" class="dropdown-item">
            <i class="far fa-id-card mr-2"></i> Profil
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url();?>login/logout" id="logout" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>
        </div>
      </li>
      <!-- Account Menu End -->
	  
	  <!-- Clock Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" href="#">
          <i class="fas fa-clock mr-2"></i>
          <b>Date And Time: <span id="time">dd/mm/yyyy 00:00:00</span></b>
          
        </a>
		
      </li>
      <!-- Account Menu End -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
     
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=base_url();?>dashboard" class="brand-link">
      <img src="<?=base_url(myapp('icon'));?>" alt="<?=myapp('icon')?>" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?=myapp('app_name')?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=base_url()?>img/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
              <?=($_SESSION['level'] != "petugas") ? $_SESSION['nama_admin'].'<br>('.ucfirst($_SESSION['level'].')') : $_SESSION['nama_petugas'];?>
          </a>
        </div>
      </div>

     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">MENU ADMIN</li>
		  
		  <li class="nav-item">
            <a href="<?=base_url()?>dashboard" class="nav-link <?php if (menu() == "Dashboard") echo 'active'; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
		  
		  
		   <li class="nav-item menu <?php if (menu() == "Admin" || menu() == "Unit" || menu() == "Petugas" || menu() == "Jenis Kendala" || menu() == "Rp Kategori" ) echo 'menu-is-opening menu-open' ; ?>" >
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-th-list"></i>
              <p>
                Data Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url()?>admin" class="nav-link <?php if (menu() == "Admin" ) echo 'active'; ?> ">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                   <p>Data Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url()?>unit" class="nav-link <?php if (menu() == "Unit") echo 'active'; ?>">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <p>Data Unit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url()?>petugas" class="nav-link <?php if (menu() == "Petugas" ) echo 'active'; ?>">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <p>Data Petugas</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="<?=base_url()?>jenis_kendala" class="nav-link <?php if (menu() == "Jenis Kendala") echo 'active'; ?>">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <p>Data Jenis Kendala</p>
                </a>
              </li>
			  <li class="nav-item"> 
                <a href="<?=base_url()?>rp_kategori" class="nav-link <?php if (menu() == "Rp Kategori") echo 'active'; ?>">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                   <p>Data Rp Kategori</p>
                </a>
              </li>
            </ul>
          </li>
		  
          
          
         
          <li class="nav-item menu <?php if (menu('child') == "Tusbung" || menu('child') == "Import Tusbung" || menu('child') == "Hasil Import Tusbung" || menu('child') == "Hari Baca Tusbung" || menu('child') == "Rupiah Baca Tusbung" || menu('child') == "Kendala Tusbung" ) echo 'menu-is-opening menu-open' ; ?>">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-th-list"></i>
              <p>
                Tusbung Kumulatif
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url()?>tusbung/import" class="nav-link <?php if (menu('child') == "Import Tusbung" || menu('child') == "Hasil Import Tusbung") echo 'active'; ?>">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <p>Import Tusbung</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url()?>tusbung" class="nav-link <?php if (menu('child') == "Tusbung") echo 'active'; ?>">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <p>Monitoring Tusbung</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url()?>tusbung/hari_baca" class="nav-link <?php if (menu('child') == "Hari Baca Tusbung" || menu('child') == "Rupiah Baca Tusbung") echo 'active'; ?>">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <p>Monitoring Hari Baca</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="<?=base_url()?>tusbung/kendala" class="nav-link <?php if (menu('child') == "Kendala Tusbung") echo 'active'; ?>">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <p>Monitoring Kendala</p>
                </a>
              </li>
            </ul>
          </li>
         
		 
		 <li class="nav-item menu <?php if (menu('child') == "Tusbung Harian"  || menu('child') == "Import Tusbung Harian" || menu('child') == "Hasil Import Tusbung Harian" || menu('child') == "Update Lunas Tusbung Harian" ) echo 'menu-is-opening menu-open' ; ?>">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-th-list"></i>
              <p>
                Tusbung Harian
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url()?>tusbung_harian/import" class="nav-link <?php if (menu('child') == "Import Tusbung Harian" || menu('child') == "Hasil Import Tusbung Harian") echo 'active'; ?>">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <p>Import Tusbung Harian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url()?>tusbung_harian" class="nav-link <?php if (menu('child') == "Tusbung Harian") echo 'active'; ?>">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <p>Monitoring Harian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url()?>tusbung_harian/update_lunas" class="nav-link <?php if (menu('child') == "Update Lunas Tusbung Harian") echo 'active'; ?>">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <p>Update Lunas</p>
                </a>
              </li>
             
            </ul>
          </li>
		   <li class="nav-header">PANDUAN APLIKASI</li>
		  <li class="nav-item">
            <a href="<?=base_url()?>" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Panduan Admin</p>
            </a>
          </li>
		  <li class="nav-item">
            <a href="<?=base_url()?>" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Panduan Manajer</p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?=menu()?></h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


	<?=$contents?>
    
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Aplikasi ini dibuat oleh <?=myapp('dev_name');?> dari <a target="blank" href="<?=myapp('link_dev');?>"><?=myapp('office_name');?></a> </strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> <?=myapp('version');?>
    </div>
  </footer>

  
</div>
<!-- ./wrapper -->


<?php include "js.php"; ?>


<?php include "tusbung_js.php"; ?>
<?php include "tusbung_harian_js.php"; ?>


<?php include "plugin_js.php"; ?>


<?php include "my_js.php"; ?>






</body>
</html>

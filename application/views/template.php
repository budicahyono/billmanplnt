<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$app?> | <?=$title?></title>
  <link rel="icon" href="<?=base_url();?>img/icon.png">	
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
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?=base_url();?>img/icon.png" alt="AdminLTELogo" height="60" width="60">
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
      

      <!-- Account Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user"></i>
          
        </a>
        
		
		<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right " style="left: inherit; right: 0px;">
          
          <div class="dropdown-divider"></div>
          <a href="<?=base_url();?>login/logout" id="logout" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url();?>login/profil" class="dropdown-item">
            <i class="far fa-id-card mr-2"></i> Profil
          </a>
         
        </div>
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
      <img src="<?=base_url();?>img/icon.png" alt="Billman PLN-T" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Billman PLN-T</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=base_url()?>img/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=$_SESSION['nama_admin'];?></a>
        </div>
      </div>

     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">MENU ADMIN</li>
		  
		  <li class="nav-item">
            <a href="<?=base_url()?>dashboard" class="nav-link <?php if ($title == "Dashboard") echo 'active'; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
		  
		  
		   <li class="nav-item menu <?php if ($title == "Admin" || $title == "Unit" || $title == "Petugas" || $title == "Jenis Kendala" || $title == "Rp Kategori" ) echo 'menu-is-opening menu-open' ; ?>" >
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-th-list"></i>
              <p>
                Data Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url()?>admin" class="nav-link <?php if ($title == "Admin") echo 'active'; ?> ">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                   <p>Data Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url()?>unit" class="nav-link <?php if ($title == "Unit") echo 'active'; ?>">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <p>Data Unit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url()?>petugas" class="nav-link <?php if ($title == "Petugas") echo 'active'; ?>">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <p>Data Petugas</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="<?=base_url()?>jenis_kendala" class="nav-link <?php if ($title == "Jenis Kendala") echo 'active'; ?>">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <p>Data Jenis Kendala</p>
                </a>
              </li>
			  <li class="nav-item"> 
                <a href="<?=base_url()?>rp_kategori" class="nav-link <?php if ($title == "Rp Kategori") echo 'active'; ?>">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                   <p>Data Rp Kategori</p>
                </a>
              </li>
            </ul>
          </li>
		  
          
          
         
          <li class="nav-item menu <?php if ($title == "Tusbung" || $title == "Import Tusbung" || $title == "Jadwal Tusbung" || $title == "Kendala" ) echo 'menu-is-opening menu-open' ; ?>">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-th-list"></i>
              <p>
                Tusbung Kumulatif
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url()?>tusbung/import" class="nav-link <?php if ($title == "Import Tusbung") echo 'active'; ?>">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <p>Import Tusbung</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url()?>tusbung" class="nav-link <?php if ($title == "Tusbung") echo 'active'; ?>">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <p>Monitoring Tusbung</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url()?>tusbung/jadwal" class="nav-link <?php if ($title == "Jadwal Tusbung") echo 'active'; ?>">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <p>Jadwal Tusbung</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="<?=base_url()?>tusbung/kendala" class="nav-link <?php if ($title == "Kendala") echo 'active'; ?>">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <p>Monitoring Kendala</p>
                </a>
              </li>
            </ul>
          </li>
         
		 
		 <li class="nav-item menu <?php if ($title == "Tusbung Harian"  || $title == "Update Kendala" ) echo 'menu-is-opening menu-open' ; ?>">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-th-list"></i>
              <p>
                Tusbung Harian
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url()?>tusbungharian" class="nav-link <?php if ($title == "Tusbung Harian") echo 'active'; ?>">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <p>Import Tusbung Harian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url()?>tusbungharian/update" class="nav-link <?php if ($title == "Update Kendala") echo 'active'; ?>">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <p>Update Kendala</p>
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
            <h1 class="m-0"><?=$title?></h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


	<?=$contents?>
    
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Aplikasi ini dibuat oleh Tim Developer dari <a href="#"><?=$app?></a> UP3 Manokwari</strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

  
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?=base_url();?>plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url();?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?=base_url();?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?=base_url();?>plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?=base_url();?>plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?=base_url();?>plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?=base_url();?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?=base_url();?>plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?=base_url();?>plugins/moment/moment.min.js"></script>
<script src="<?=base_url();?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?=base_url();?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?=base_url();?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?=base_url();?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url();?>dist/js/adminlte.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?=base_url();?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url();?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url();?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url();?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url();?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url();?>plugins/jszip/jszip.min.js"></script>
<script src="<?=base_url();?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?=base_url();?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?=base_url();?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url();?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url();?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- datatable -->
<script>
  $(function () {
  //datatable standar
    $('#datatable').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      columnDefs: [
        { orderable: false, targets: -1}
      ],
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  //datatable pilihan pagination  
    $('#data_paging').DataTable({
      "paging": true,
      "lengthMenu": [[20, 50, 100], [20, 50, 100]],
      "searching": false,
      "ordering": true,
      columnDefs: [
        { orderable: false, targets: -1},
        { orderable: false, targets: 4},
      ],
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  //datatable pencarian  
     $('#data_search').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<!-- alert success -->
<script>
<?php if ($this->session->flashdata('success')) { ?>	 
    $(document).ready(function() {
      $(document).Toasts('create', {
        class: 'bg-success',
        title: 'Success',
        subtitle: '',
		autohide: true,
        delay: 5000,
        body: "<?= $this->session->flashdata('success') ?>"
      })
    });
<?php } ?>	
</script>

<!-- alert error -->
<script>
<?php if ($this->session->flashdata('error')) { ?>	
	$(document).ready(function() {
      $(document).Toasts('create', {
        class: 'bg-danger',
        title: 'Error',
        subtitle: '',
		autohide: true,
        delay: 5000,
        body: "<?= $this->session->flashdata('error') ?>"
      })
    });
<?php } ?>		
</script>

<!-- logout  -->
<script>
 $('#logout').click(function(){
    var reallyLogout=confirm("Apa anda yakin ingin keluar?");
    if(reallyLogout){
        return true
    } else {
       return false
    }
});
</script>

<!--  javascript pilih unit di petugas  -->
<script>
 $('#id_unit').change(function () {
    var id_unit = $(this).val();
    window.location.replace("<?=base_url()?>petugas/unit/" + id_unit);
 });  
</script>

<!-- upload file   -->
<script>
 $(function () {
 
    $('#uploadBtn').change(function () {
      var path = $(this)[0].files[0].name;
      $("#uploadFile").val(path);
    });       
 
 })
</script>


</body>
</html>

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
          <a href="<?=base_url();?>login/profil" class="dropdown-item">
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
		  
          
          
         
          <li class="nav-item menu <?php if ($title == "Tusbung" || $title == "Import Tusbung" || $title == "Hasil Import Tusbung" || $title == "Jadwal Tusbung" || $title == "Kendala" ) echo 'menu-is-opening menu-open' ; ?>">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-th-list"></i>
              <p>
                Tusbung Kumulatif
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url()?>tusbung/import" class="nav-link <?php if ($title == "Import Tusbung" || $title == "Hasil Import Tusbung") echo 'active'; ?>">
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
                <a href="<?=base_url()?>tusbungharian/import" class="nav-link <?php if ($title == "Tusbung Harian") echo 'active'; ?>">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <p>Import Tusbung Harian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url()?>tusbungharian" class="nav-link <?php if ($title == "Update Kendala") echo 'active'; ?>">
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
<!-- jQuery Knob Chart -->
<script src="<?=base_url();?>plugins/jquery-knob/jquery.knob.min.js"></script>
<script> 
    $(function () {
    /* jQueryKnob */

    $('.knob').knob({
        'format' : function (value) {
          return value + '%';
        },
      /*change : function (value) {
       //console.log("change : " + value);
       },
       release : function (value) {
       console.log("release : " + value);
       },
       cancel : function () {
       console.log("cancel : " + this.value);
       },*/
      draw: function () {

        // "tron" case
        if (this.$.data('skin') == 'tron') {

          var a   = this.angle(this.cv)  // Angle
            ,
              sa  = this.startAngle          // Previous start angle
            ,
              sat = this.startAngle         // Start angle
            ,
              ea                            // Previous end angle
            ,
              eat = sat + a                 // End angle
            ,
              r   = true

          this.g.lineWidth = this.lineWidth

          this.o.cursor
          && (sat = eat - 0.3)
          && (eat = eat + 0.3)

          if (this.o.displayPrevious) {
            ea = this.startAngle + this.angle(this.value)
            this.o.cursor
            && (sa = ea - 0.3)
            && (ea = ea + 0.3)
            this.g.beginPath()
            this.g.strokeStyle = this.previousColor
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
            this.g.stroke()
          }

          this.g.beginPath()
          this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
          this.g.stroke()

          this.g.lineWidth = 2
          this.g.beginPath()
          this.g.strokeStyle = this.o.fgColor
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false)
          this.g.stroke()

          return false
        }
      }
    })
    /* END JQUERY KNOB */

    

  })

</script>

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
  //datatable khusus tusbung  
    $('#data_tusbung').DataTable({
      "paging": true,
      "lengthMenu": [[20, 50, 100], [20, 50, 100]],
      "searching": false,
      "ordering": true,
      columnDefs: [
        { orderable: false, targets: -1},
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

<?php if ($this->uri->segment(1) == "petugas") { ?>
<!--  javascript pilih unit di petugas  -->
<script>
 $('#id_unit').change(function () {
    var id_unit = $(this).val();
    window.location.replace("<?=base_url()?>petugas/unit/" + id_unit);
 });  
</script>
<?php } ?>

<?php if ($this->uri->segment(1) == "tusbung") { ?>
<!--  javascript pilih unit di tusbung  -->
<script>
 $('#id_unit').change(function () {
    var id_unit = $(this).val();
    if (id_unit == 1) {
       window.location.replace("<?=base_url()?>tusbung");
    } else {
       window.location.replace("<?=base_url()?>tusbung?id_unit=" + id_unit);
    } 
   
 });  
</script>
<?php } ?>

<!--  javascript pilih unit di jadwal tusbung  -->
<script>
 $('#id_unit_jadwal').change(function () {
    var id_unit = $(this).val();
    if (id_unit == 1) {
       window.location.replace("<?=base_url()?>tusbung/jadwal");
    } else {
       window.location.replace("<?=base_url()?>tusbung/jadwal?id_unit=" + id_unit);
    } 
   
 });  
</script>

<!--  javascript pilih unit di rupiah baca tusbung  -->
<script>
 $('#id_unit_rp_baca').change(function () {
    var id_unit = $(this).val();
    if (id_unit == 1) {
       window.location.replace("<?=base_url()?>tusbung/rp_baca");
    } else {
       window.location.replace("<?=base_url()?>tusbung/rp_baca?id_unit=" + id_unit);
    } 
   
 });  
</script>

<!--  javascript pilih unit dan tanggal di update kendala  -->
<script>
$(document).ready(function() {       
  function ganti_tgl_unit() {
    var tgl_skrg = $("#tanggal_harian").val();
    var id_unit = $("#id_unit_harian").val();
    
    
    if (id_unit == 1 && tgl_skrg == <?=date("d")?>) {
       window.location.replace("<?=base_url()?>tusbungharian");
    } else {
       window.location.replace("<?=base_url()?>tusbungharian?id_unit=" + id_unit + "&tgl_skrg=" + tgl_skrg);
    } 
    
  }    

    
  $("#tanggal_harian, #id_unit_harian").on("change", ganti_tgl_unit); 
}) 
</script>

<!--  javascript bulan tahun di menu atas  -->
<script>
$(document).ready(function() {    
// munculkan menu bulan tahun
  $("#bulan_tahun").click(function(){
    $("#bulan_tahun_open").toggle();
  }); 
  
  $("#submit_form").click(function(){
      var bulan = $("#bulan_form").val();
      var tahun = $("#tahun_form").val();
      var url = $("#url_form").val();
      window.location.replace("<?=base_url()?>login/change?bulan=" + bulan + "&tahun=" + tahun + "&url=" + url);
  }); 
  
})
</script>

<!--  javascript date and time di menu atas  -->
<script>
setInterval(myTimer, 1000);

function myTimer() {
  const date = new Date();
  document.getElementById("time").innerHTML = date.toLocaleString('id-ID',  { hour12: false });
}
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

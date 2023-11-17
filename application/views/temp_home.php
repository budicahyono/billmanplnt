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
  <link rel="stylesheet" href="<?=base_url();?>dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?=base_url();?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?=base_url();?>plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?=base_url();?>plugins/summernote/summernote-bs4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?=base_url();?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?=base_url();?>plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url();?>dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page" style="height:80vh !important">

<?=$contents?>

<!-- jQuery -->
<script src="<?=base_url();?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url();?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?=base_url();?>plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?=base_url();?>plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url();?>dist/js/adminlte.min.js"></script>


<!-- intip password -->
<script>
$("#open_pass").on("click", function(){
	var type_pass = $('#password').attr('type');
	if (type_pass == "password") {
		$('#password').attr('type', 'text');
		$('#eye').attr('class', 'fas fa-eye');
	} else {
		$('#password').attr('type', 'password');
		$('#eye').attr('class', 'fas fa-eye-slash');
	}
}); 	
</script>

<!-- alert -->
<script>
  $(function() {
<?php if ($this->session->flashdata('success')) { ?>	 
    $(document).ready(function() {
      $(document).Toasts('create', {
        class: 'bg-success',
        title: 'Success',
        subtitle: '',
		autohide: true,
        delay: 5000,
        body: '<?= $this->session->flashdata('success') ?>'
      })
    });
<?php } ?>	
	
<?php if ($this->session->flashdata('error')) { ?>	
	$(document).ready(function() {
      $(document).Toasts('create', {
        class: 'bg-danger',
        title: 'Error',
        subtitle: '',
		autohide: true,
        delay: 5000,
        body: '<?= $this->session->flashdata('error') ?>'
      })
    });
<?php } ?>		
	
  });
</script>





</body>
</html>

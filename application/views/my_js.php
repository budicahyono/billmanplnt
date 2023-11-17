<!-- List of custom javascript -->

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
     "lengthMenu": [[20, 50, 100], [20, 50, 100]],
      "searching": true,
      "ordering": true,
     columnDefs: [
        { orderable: false, targets: -1},
      ],
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
       window.location.replace("<?=base_url()?>tusbung_harian");
    } else {
       window.location.replace("<?=base_url()?>tusbung_harian?id_unit=" + id_unit + "&tgl_skrg=" + tgl_skrg);
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
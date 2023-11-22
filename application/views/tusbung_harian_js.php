<!-- Tusbung Custom Javascript -->

<?php $no=1; 
 if (menu('child') == "Tusbung Harian") {   
 
 // Data Petugas ================================================================== 
     foreach ($petugas->result() as $r) {
	 $id = $r->id_petugas;	  
	?>   
	
	<!-- Modal -->
     <div class="modal fade" id="modal_edit_<?=$id?>" role="dialog" style="scroll-behavior: smooth;"> 
    <div class="modal-dialog modal-xl animate_margin" id="margin_<?=$id?>" style="margin:28px calc(20%)"> 	
      
      <!-- Modal Edit-->
     <div class="modal-content animate_modal" id="content_edit_<?=$id?>">
            <div class="modal-header">
              <h4 class="modal-title" id="atas_modal_<?=$id?>">Edit Kendala Harian Berdasarkan Petugas <span style="text-transform: capitalize;font-weight:bold" id="title_modal_<?=$id?>"></span></h4>
              
              
              <div class="form-group" style="float:right">
                
                <button type="button" class="btn btn-tool" id="maximize_<?=$id?>"><i class="fas fa-expand"></i>
                  </button>
                 <button type="button" class="btn btn-tool" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i>
                  </button>  
              </div> 
              
              
               
            </div>
            <div class="modal-body">
             <div class="form-group">
                <label>Apa Kendala Hari Ini?</label>
                <input value="" required name="kendala_harian_<?=$id?>" id="kendala_harian_<?=$id?>" type="text" class="form-control" >
                <input value="<?=$id?>" required name="id_petugas_kendala_<?=$id?>" id="id_petugas_kendala_<?=$id?>" type="hidden"  >
                </div>
              
              
            </div>
            <div class="modal-footer justify-content-between" id="bawah_modal_<?=$id?>">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
			  <button id="save_kendala_<?=$id?>" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
              </div>
            </div>
            
          </div>
      
    </div>
  </div>
  
  
 
<script>
$(document).ready(function() {  
    
   
  //jquery ketika user klik edit kendala
  $("#edit_kendala_<?=$r->id_petugas?>").click(function(){
    var nama_petugas = $(this).data("name");
    var id_petugas = $(this).data("id");
    
    $("#id_petugas_<?=$id?>").val(id_petugas);
    var nama = nama_petugas.toLowerCase();
    
    $("#modal_edit_<?=$id?>").modal();
    $("#title_modal_<?=$id?>").html(nama);
    
    
    
    
    
    
    //ketika muncul modals pelanggan
    $("#modal_edit_<?=$id?>").on('shown.bs.modal', function(){
        var width_content =  $("#content_edit_<?=$id?>").outerWidth();
        $("#w_content_<?=$id?>").val(width_content); 
        
        var lebar = $("#get_width_<?=$id?>").outerWidth();
        $("#isi_width_<?=$id?>").outerWidth(lebar);
        $("#isi_modal_<?=$id?>").scroll(function(){
                $("#isi_modal2_<?=$id?>")
                .scrollLeft($("#isi_modal_<?=$id?>").scrollLeft());
        });
        $("#isi_modal2_<?=$id?>").scroll(function(){
                $("#isi_modal_<?=$id?>")
                .scrollLeft($("#isi_modal2_<?=$id?>").scrollLeft());
        });
        
         
        
    });
    
   
    //ketika modals pelanggan ditutup
    $("#modal_edit_<?=$id?>").on('hide.bs.modal', function(){
        $("#direction_<?=$id?>").fadeOut();
        var width_content =  $("#w_content_<?=$id?>").val();
        $("#content_edit_<?=$id?>").width(width_content);
        $("#margin_<?=$id?>").css("margin", "28px calc(20%)"); 
        open = 0;
        $("#limit_<?=$id?>").val(10);
         
        $("#isi_modal2_<?=$id?>, #isi_modal_<?=$id?>").show();
        $("#isi_detail_<?=$id?>").hide(); 
        
    });
   
    
  }); 
  var open = 0;
  
  
   //jquery ketika user klik simpan
  $("#save_kendala_<?=$id?>").click(function(){
	var kendala_harian = $("#kendala_harian_<?=$id?>").val(); 
	var id_petugas_kendala = $("#id_petugas_kendala_<?=$id?>").val(); 
	$.ajax({
			type: 'POST',
			data: {kendala_harian:kendala_harian, id_petugas_kendala:id_petugas_kendala},
			url: "<?php echo base_url(); ?>tusbung_harian/save",
			success: function(data) {
                $(document).Toasts('create', {
					class: 'bg-success',
					title: 'Success',
					subtitle: '',
					autohide: true,
					delay: 5000,
					body: "Kendala Harian telah disimpan"
				  })
                
			}
		});
      
  
  })
  
  //jquery ketika user klik maximize di modals pelanggan
  $("#maximize_<?=$id?>").click(function(){
    
    if (open == 0) {
      var window_width = $(window).width();
      var dikurang = parseInt(window_width - 20);
      
      $("#content_<?=$id?>").css("width", dikurang+"px");
      $("#margin_<?=$id?>").css("margin", "0 10px 0 0"); 
      
      open = 1;
    } else {
      var width_content =  $("#w_content_<?=$id?>").val();
      $("#w_content_<?=$id?>").val(width_content); 
      $("#content_<?=$id?>").outerWidth(width_content);
      $("#content_<?=$id?>").css("width", width_content+"px");
      $("#margin_<?=$id?>").css("margin", "28px calc(20%)"); 
      open = 0;
    }  
  }); 
  
  //jquery ketika user pilih limit data
  $("#limit_<?=$id?>").change(function(){
    var id_petugas = $("#id_petugas_<?=$id?>").val();
    var limit =  $("#limit_<?=$id?>").val();
    var jenis =  $("#jenis_<?=$id?>").val();
    $("#sum_<?=$id?>").val(limit);
    $("#modal_app_<?=$id?>").modal();
    ajax_tusbung(id_petugas, jenis, limit)
    $("#isi_modal2_<?=$id?>, #isi_modal_<?=$id?>").show();
    $("#isi_detail_<?=$id?>").hide(); 
    
  }); 

  //jquery ketika user klik load data
  var jumlah = 0;
  $("#load_<?=$id?>").click(function(){
    var id_petugas = $("#id_petugas_<?=$id?>").val();
    var limit =  parseInt($("#limit_<?=$id?>").val());
    var jenis =  $("#jenis_<?=$id?>").val();
    jumlah =  parseInt($("#sum_<?=$id?>").val());
    var sum = jumlah + limit;
    $("#sum_<?=$id?>").val(sum);
    $("#modal_app_<?=$id?>").modal();
    ajax_tusbung(id_petugas, jenis, sum)
    $("#isi_modal2_<?=$id?>, #isi_modal_<?=$id?>").show();
    $("#isi_detail_<?=$id?>").hide(); 
    
    
  }); 
  
  //jquery ketika user ketik di input search
  $("#search_<?=$id?>").keyup(function(){
    $("#isi_modal2_<?=$id?>, #isi_modal_<?=$id?>").show();
    $("#isi_detail_<?=$id?>").hide(); 
    
    
    var search =  $("#search_<?=$id?>").val();
    var id_petugas = $("#id_petugas_<?=$id?>").val();
    var jenis =  $("#jenis_<?=$id?>").val();
    if (search == "") {
      $("#auto_<?=$id?>").css("display", "none");
      $("#auto_<?=$id?>").html("");
      ajax_tusbung(id_petugas, jenis)
    } else {
      $("#auto_<?=$id?>").css("display", "flex");
      $.ajax({
            dataType: 'json',
			url: "<?php echo base_url(); ?>tusbung/search/" + id_petugas + "?id_unit=<?=$id_unit?>&jenis="+jenis+"&q="+ search,
			success: function(data) {
                $('#auto_<?=$id?>').empty();
                var no = 1;
                data.data_rows.forEach(function(data_rows) {
                    var row = '<a href="javascript:void(0)" class="list-group-item" id="auto_li_<?=$id?>_'+no+'" data-id="'+data_rows.id_pelanggan+'">';
                     row += data_rows.id_pelanggan+' '+data_rows.nama_pelanggan;
                     row += '</a>';
                    $('#auto_<?=$id?>').append(row);
                    
                    
                    $("#auto_li_<?=$id?>_"+no).click(function(){
                        var isi_auto =  $(this).data("id");
                        var id_petugas =  data.id_petugas;
                        $("#search_<?=$id?>").val(isi_auto);
                        $("#auto_<?=$id?>").css("display", "none");
                        ajax_tusbung(id_petugas, jenis, null, isi_auto)
                    })
                no = no + 1;
                })
                if (data.total_rows == 0) {
                   var row = '<a href="javascript:void(0)" class="list-group-item">Data tidak ditemukan!!</a>';
                    $('#auto_<?=$id?>').append(row);
                }
                
			}
		});
      
      
      
      
    }
    
  }); 
  
  
})
</script>
    
 <?php $no = $no+ 1;} 
 
 // Data Petugas Khusus ================================================================== 
 
 foreach ($petugas_khusus->result() as $r) {
 ?>
 <div class="form-group" id="direction_<?=$id?>" style="position:fixed;bottom:1px;right:152px;z-index:1051;display:none;">
         <a  class="btn btn-warning" href="#atas_modal_<?=$id?>"><i class="fas fa-chevron-up"></i></a> 
        <a  class="btn btn-warning" href="#bawah_modal_<?=$id?>"><i class="fas fa-chevron-down"></i></a> 
    </div>
     
     <!-- Modal -->
     <div class="modal fade" id="modal_app_<?=$id?>" role="dialog" style="scroll-behavior: smooth;"> 
    <div class="modal-dialog modal-xl animate_margin" id="margin_<?=$id?>" style="margin:28px calc(20%)"> 
     
     
      
      <!-- Modal content-->
     <div class="modal-content animate_modal" id="content_<?=$id?>">
            <div class="modal-header">
              <h4 class="modal-title" id="atas_modal_<?=$id?>">Data <span id="title_jenis_<?=$id?>"></span> Berdasarkan Petugas <span style="text-transform: capitalize;font-weight:bold" id="title_modal_<?=$id?>"></span></h4>
              
              
              <div class="form-group" style="float:right">
                
                <button type="button" class="btn btn-tool" id="maximize_<?=$id?>"><i class="fas fa-expand"></i>
                  </button>
                 <button type="button" class="btn btn-tool" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i>
                  </button>  
              </div> 
              
              
               
            </div>
            <div class="modal-body">
             <div class="form-group row">
              <div class="col-lg-4">
                  <div class="form-group row" style="padding-top:10px">
                    <label for="limit" class="col-sm-2 col-form-label">Show</label>
                    <div class="col-sm-8">
                      <input type="hidden" class="form-control" id="id_petugas_<?=$id?>"  >
                      <input type="hidden" class="form-control" id="sum_<?=$id?>"  >
                      <input type="hidden" class="form-control" id="jenis_<?=$id?>"  >
                      <input type="hidden" class="form-control" id="w_content_<?=$id?>"  >
                      <select name="limit_<?=$id?>" id="limit_<?=$id?>" class="form-control"  >
                        <option value="10" selected>10</option>
                        <option value="20" >20</option>
                        <option value="30" >30</option>
                        <option value="50" >50</option>
                        <option value="100" >100</option>
                        <option value="500" >500</option>
                      </select>
                       <small>Total <span id="total_<?=$id?>"></span> entries</small>
                    </div>
                   
                  </div> 
              </div>
              <div class="col-lg-8">
                  <div class="form-group row" style="padding-top:10px">
                    <div class="col-sm-3">
                    </div>
                    <label for="limit" class="col-sm-1 col-form-label">Search</label>
                    <div class="col-sm-8 auto_input">
                     <input placeholder="Cari ID atau nama pelanggan" type="text" class="form-control" id="search_<?=$id?>"  name="search_<?=$id?>">
                     <div class="list-group auto" id="auto_<?=$id?>" style="display:none">
                        
                     </div>
                     
                    </div>
                  </div> 
              </div>
              </div>
            <div id="isi_modal_<?=$id?>" style="overflow-x:scroll;overflow-y:hidden;padding:0px">
              <div id="isi_width_<?=$id?>" style="height:1px">
              </div>
            </div >
            <div id="isi_modal2_<?=$id?>"  style="overflow-x:scroll;padding:0px" >
             
              <table id="get_width_<?=$id?>" class="table table-bordered table-hover" >
                  <thead >
                  <tr>
                    <th>No</th>
                    <th>ID Pelanggan</th>
                    <th>Nama</th>
                    <th>Tarif</th>
                    <th>Daya</th>
                    <th>Gol</th>
                    <th>Alamat</th>
                    <th>KDDK</th>
                    <th>No.HP</th>
                    <th>Rptag</th>
                    <th>RBK</th>
                    <th>Lunas?</th>
                    <th>Tgl.Lunas</th>
                  </tr>
                  </thead>
                  <tbody id="tabel_isi_<?=$id?>" >
                   <tr>
                      <td>No</td>
                      <td>ID Pelanggan</td>
                      <td>Nama</td>
                      <td>Tarif</td>
                      <td>Daya</td>
                      <td>Gol</td>
                      <td>Alamat</td>
                      <td>KDDK</td>
                      <td>No.HP</td>
                      <td>Rptag</td>
                      <td>RBK</td>
                      <td>Lunas?</td>
                      <td>Tgl.Lunas</td>
                  </tr>
                </table>
            </div>
            
            <div id="isi_detail_<?=$id?>" style="overflow-x:scroll;padding:0px;display:none">
                <div class="form-group" style="margin-top:10px"> 
                      <button id="tutup_detail_<?=$id?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali</button>
                  </div>
                  <table id="get_detail_width_<?=$id?>" class="table table-bordered table-hover" >
                    <thead >
                    <tr>
                      <th>No</th>
                      <th>ID Pelanggan</th>
                      <th>Nama</th>
                      <th>Tarif</th>
                      <th>Daya</th>
                      <th>Gol</th>
                      <th>Alamat</th>
                      <th>KDDK</th>
                      <th>No.HP</th>
                      <th>Rptag</th>
                      <th>RBK</th>
                      <th>Lunas?</th>
                      <th>Tgl.Lunas</th>
                      <th>Bulan</th>
                      <th>Tahun</th>
                      <th>Jenis Kendala</th>
                    </tr>
                    </thead>
                    <tbody id="tabel_detail_<?=$id?>" >
                     <tr>
                        <td>No</td>
                        <td>ID Pelanggan</td>
                        <td>Nama</td>
                        <td>Tarif</td>
                        <td>Daya</td>
                        <td>Gol</td>
                        <td>Alamat</td>
                        <td>KDDK</td>
                        <td>No.HP</td>
                        <td >Rptag</td>
                        <td>RBK</td>
                        <td>Lunas?</td>
                        <td>Tgl.Lunas</td>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Jenis Kendala</th>
                    </tr>
                  </table>
              </div>
              
            </div>
            <div class="modal-footer justify-content-between" id="bawah_modal_<?=$id?>">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close
              <button type="button" class="btn btn-primary" id="load_<?=$id?>"><i class="fas fa-sync"></i> Load Data</button>
              </div>
            </div>
            
          </div>
      
    </div>
  </div>
  
  
 
<script>
$(document).ready(function() {  
    
  //function panggil data pelanggan  
  function ajax_tusbung(id_petugas, jenis = null, limit = null, q = null) {
    if (limit == null) {
      isi_limit = 10;
    } else {
      isi_limit = limit;
    }
    
    if (q == null) {
      q_url = ""; 
    } else {
      q_url = "&q="+ q;
    }
    
    $.ajax({
			dataType: 'json',
			url: "<?php echo base_url(); ?>tusbung/petugas/" + id_petugas + "?id_unit=<?=$id_unit?>&jenis="+jenis+"&limit="+ isi_limit + q_url,
			success: function(data) {
                $('#tabel_isi_<?=$id?>').empty();
                var no = 1;
                data.data_rows.forEach(function(data_rows) {
                    var row = '<tr>';
                    row += '<td>'+no+'</td>';
                    
                    if (data.total == null) {
                        row += '<td><a href="javascript:void(0)" id="detail_'+id_petugas+'_'+no+'"   data-id="'+data_rows.id_pelanggan+'"  >'+data_rows.id_pelanggan+'</a></td>';
                    } else {
                      row += '<td><a href="javascript:void(0)" id="detail_total_'+no+'"   data-id="'+data_rows.id_pelanggan+'"  >'+data_rows.id_pelanggan+'</a></td>';
                    } 
                        
                    row += '<td>'+data_rows.nama_pelanggan+'</td>';
                    row += '<td>'+data_rows.tarif+'</td>';
                    row += '<td>'+data_rows.daya+'</td>';
                    row += '<td>'+data_rows.gol+'</td>';
                    row += '<td>'+data_rows.alamat+'</td>';
                    row += '<td>'+data_rows.kddk+'</td>';
                    row += '<td>'+data_rows.no_hp+'</td>';
                    row += '<td style="white-space: nowrap;">'+data_rows.rptag+'</td>';
                    row += '<td>'+data_rows.rbk+'</td>';
                    
                    if (data_rows.is_lunas == 1) {
                        var lunas = "lunas";	
                    } else {
                        var lunas = "blm lunas";	
                    }
                    row += '<td>'+lunas+'</td>';
                    row += '<td>'+data_rows.tgl_lunas+'</td>';
                    row += '</tr>';
                    
                    
                    $('#tabel_isi_<?=$id?>').append(row);
                    
                    if (data.total == null) {
                        $("#detail_"+id_petugas+"_"+no).click(function(){
                            var id_pelanggan = $(this).data("id");
                            detail(id_pelanggan);
                        
                        })
                    } else {
                         $("#detail_total_"+no).click(function(){
                            var id_pelanggan = $(this).data("id");
                            detail(id_pelanggan);
                        })  
                    }
                    
                    
                    
                no = no + 1;
                })
                var lebar = $("#get_width_<?=$id?>").outerWidth();
                $("#isi_width_<?=$id?>").outerWidth(lebar);
                if (data.total_rows == 0) {
                    var row = '<tr>';
                    row += '<td colspan="14" class="text-center"><b>TIDAK ADA DATA</b></td>';
                    row = '</tr>';
                    $('#tabel_isi_<?=$id?>').append(row);
                }
                
                
			}
		});    
  }
  
  //jquery ketika user klik detail pada id_pelanggan
  function detail(id){
      $("#isi_modal2_<?=$id?>").hide();
      $("#isi_detail_<?=$id?>").show();
      $("#auto_<?=$id?>").html("");
      
      $.ajax({
            dataType: 'json',
			url: "<?php echo base_url(); ?>tusbung/detail/" + id,
			success: function(data) {
                $('#tabel_detail_<?=$id?>').empty();
                var no = 1;
                data.data_rows.forEach(function(data_rows) {
                    var row = '<tr>';
                    row += '<td>'+no+'</td>';
                    row += '<td>'+data_rows.id_pelanggan+'</a></td>';
                    row += '<td>'+data_rows.nama_pelanggan+'</td>';
                    row += '<td>'+data_rows.tarif+'</td>';
                    row += '<td>'+data_rows.daya+'</td>';
                    row += '<td>'+data_rows.gol+'</td>';
                    row += '<td>'+data_rows.alamat+'</td>';
                    row += '<td>'+data_rows.kddk+'</td>';
                    row += '<td>'+data_rows.no_hp+'</td>';
                    row += '<td style="white-space: nowrap;">'+data_rows.rptag+'</td>';
                    row += '<td>'+data_rows.rbk+'</td>';
                    
                    if (data_rows.is_lunas == 1) {
                        var lunas = "lunas";	
                    } else {
                        var lunas = "blm lunas";	
                    }
                    row += '<td>'+lunas+'</td>';
                    row += '<td>'+data_rows.tgl_lunas+'</td>';
                    row += '<td>'+data_rows.bulan+'</td>';
                    row += '<td>'+data_rows.tahun+'</td>';
                    row += '<td>'+data_rows.nama_jenis_kendala+'</td>';
                    row += '</tr>';
                    
                    
                    $('#tabel_detail_<?=$id?>').append(row);
                    var lebar = $("#get_detail_width_<?=$id?>").outerWidth();
                    $("#isi_width_<?=$id?>").outerWidth(lebar);
                    $("#isi_modal_<?=$id?>").scroll(function(){
                        $("#isi_detail_<?=$id?>")
                        .scrollLeft($("#isi_modal_<?=$id?>").scrollLeft());
                    });
                    $("#isi_detail_<?=$id?>").scroll(function(){
                        $("#isi_modal_<?=$id?>")
                        .scrollLeft($("#isi_detail_<?=$id?>").scrollLeft());
                    });
                    
                no = no + 1;
                })
                if (data.total_rows == 0) {
                    var row = '<tr>';
                    row += '<td colspan="14" class="text-center"><b>TIDAK ADA DATA</b></td>';
                    row = '</tr>';
                    $('#tabel_detail_<?=$id?>').append(row);
                }
                
			}
		});
  }
  
  //jquery ketika user klik tutup detail
  $("#tutup_detail_<?=$id?>").click(function(){
    $("#isi_modal2_<?=$id?>, #isi_modal_<?=$id?>").show();
    $("#isi_detail_<?=$id?>").hide();
    var lebar = $("#get_width_<?=$id?>").outerWidth();
    $("#isi_width_<?=$id?>").outerWidth(lebar);
    
  })
   
  //jquery ketika user klik angka tul, lunas, dan belum lunas 
  $("#tul_<?=$id?>, #lunas_<?=$id?>, #blm_<?=$id?>").click(function(){
    var nama_petugas = $(this).data("name");
    var id_petugas = $(this).data("id");
    var sum = $(this).data("sum");
    var jenis = $(this).data("jenis");
    if (jenis == "tul") {
        var title_jenis = "Semua Pelanggan";
    } else if (jenis == "lunas") {
        var title_jenis = "Pelanggan Lunas";
    } else {
        var title_jenis = "Pelanggan Belum Lunas";
    }
    
    $("#id_petugas_<?=$id?>").val(id_petugas);
    $("#sum_<?=$id?>").val(10);
    $("#jenis_<?=$id?>").val(jenis);
    var nama = nama_petugas.toLowerCase();
    
    $("#modal_edit_<?=$id?>").modal();
    $("#title_modal_<?=$id?>").html(nama);
    $("#total_<?=$id?>").html(sum);
    $("#search_<?=$id?>").val("");
    $("#auto_<?=$id?>").html("");
    
    $("#direction_<?=$id?>").fadeIn();
    ajax_tusbung(id_petugas, jenis);
    
    
    
    
    
    //ketika muncul modals pelanggan
    $("#modal_app_<?=$id?>").on('shown.bs.modal', function(){
        var width_content =  $("#content_<?=$id?>").outerWidth();
        $("#w_content_<?=$id?>").val(width_content); 
        
        var lebar = $("#get_width_<?=$id?>").outerWidth();
        $("#isi_width_<?=$id?>").outerWidth(lebar);
        $("#isi_modal_<?=$id?>").scroll(function(){
                $("#isi_modal2_<?=$id?>")
                .scrollLeft($("#isi_modal_<?=$id?>").scrollLeft());
        });
        $("#isi_modal2_<?=$id?>").scroll(function(){
                $("#isi_modal_<?=$id?>")
                .scrollLeft($("#isi_modal2_<?=$id?>").scrollLeft());
        });
        
         
        
    });
    
   
    //ketika modals pelanggan ditutup
    $("#modal_app_<?=$id?>").on('hide.bs.modal', function(){
        $("#direction_<?=$id?>").fadeOut();
        var width_content =  $("#w_content_<?=$id?>").val();
        $("#content_<?=$id?>").width(width_content);
        $("#margin_<?=$id?>").css("margin", "28px calc(20%)"); 
        open = 0;
        $("#limit_<?=$id?>").val(10);
         
        $("#isi_modal2_<?=$id?>, #isi_modal_<?=$id?>").show();
        $("#isi_detail_<?=$id?>").hide(); 
        
    });
   
    
  }); 
  var open = 0;
  
  
  //jquery ketika user klik maximize di modals pelanggan
  $("#maximize_<?=$id?>").click(function(){
    
    if (open == 0) {
      var window_width = $(window).width();
      var dikurang = parseInt(window_width - 20);
      
      $("#content_<?=$id?>").css("width", dikurang+"px");
      $("#margin_<?=$id?>").css("margin", "0 10px 0 0"); 
      
      open = 1;
    } else {
      var width_content =  $("#w_content_<?=$id?>").val();
      $("#w_content_<?=$id?>").val(width_content); 
      $("#content_<?=$id?>").outerWidth(width_content);
      $("#content_<?=$id?>").css("width", width_content+"px");
      $("#margin_<?=$id?>").css("margin", "28px calc(20%)"); 
      open = 0;
    }  
  }); 
  
  //jquery ketika user pilih limit data
  $("#limit_<?=$id?>").change(function(){
    var id_petugas = $("#id_petugas_<?=$id?>").val();
    var limit =  $("#limit_<?=$id?>").val();
    var jenis =  $("#jenis_<?=$id?>").val();
    $("#sum_<?=$id?>").val(limit);
    $("#modal_app_<?=$id?>").modal();
    ajax_tusbung(id_petugas, jenis, limit)
    $("#isi_modal2_<?=$id?>, #isi_modal_<?=$id?>").show();
    $("#isi_detail_<?=$id?>").hide(); 
    
  }); 

  //jquery ketika user klik load data
  var jumlah = 0;
  $("#load_<?=$id?>").click(function(){
    var id_petugas = $("#id_petugas_<?=$id?>").val();
    var limit =  parseInt($("#limit_<?=$id?>").val());
    var jenis =  $("#jenis_<?=$id?>").val();
    jumlah =  parseInt($("#sum_<?=$id?>").val());
    var sum = jumlah + limit;
    $("#sum_<?=$id?>").val(sum);
    $("#modal_app_<?=$id?>").modal();
    ajax_tusbung(id_petugas, jenis, sum)
    $("#isi_modal2_<?=$id?>, #isi_modal_<?=$id?>").show();
    $("#isi_detail_<?=$id?>").hide(); 
    
    
  }); 
  
  //jquery ketika user ketik di input search
  $("#search_<?=$id?>").keyup(function(){
    $("#isi_modal2_<?=$id?>, #isi_modal_<?=$id?>").show();
    $("#isi_detail_<?=$id?>").hide(); 
    
    
    var search =  $("#search_<?=$id?>").val();
    var id_petugas = $("#id_petugas_<?=$id?>").val();
    var jenis =  $("#jenis_<?=$id?>").val();
    if (search == "") {
      $("#auto_<?=$id?>").css("display", "none");
      $("#auto_<?=$id?>").html("");
      ajax_tusbung(id_petugas, jenis)
    } else {
      $("#auto_<?=$id?>").css("display", "flex");
      $.ajax({
            dataType: 'json',
			url: "<?php echo base_url(); ?>tusbung/search/" + id_petugas + "?id_unit=<?=$id_unit?>&jenis="+jenis+"&q="+ search,
			success: function(data) {
                $('#auto_<?=$id?>').empty();
                var no = 1;
                data.data_rows.forEach(function(data_rows) {
                    var row = '<a href="javascript:void(0)" class="list-group-item" id="auto_li_<?=$id?>_'+no+'" data-id="'+data_rows.id_pelanggan+'">';
                     row += data_rows.id_pelanggan+' '+data_rows.nama_pelanggan;
                     row += '</a>';
                    $('#auto_<?=$id?>').append(row);
                    
                    
                    $("#auto_li_<?=$id?>_"+no).click(function(){
                        var isi_auto =  $(this).data("id");
                        var id_petugas =  data.id_petugas;
                        $("#search_<?=$id?>").val(isi_auto);
                        $("#auto_<?=$id?>").css("display", "none");
                        ajax_tusbung(id_petugas, jenis, null, isi_auto)
                    })
                no = no + 1;
                })
                if (data.total_rows == 0) {
                   var row = '<a href="javascript:void(0)" class="list-group-item">Data tidak ditemukan!!</a>';
                    $('#auto_<?=$id?>').append(row);
                }
                
			}
		});
      
      
      
      
    }
    
  }); 
  
  
})
</script>
 
  
 
 
 <?php } 
 // Untuk Total ================================================================== 
 
 ?>
 <div class="form-group" id="direction_total" style="position:fixed;bottom:1px;right:152px;z-index:1051;display:none;">
         <a  class="btn btn-warning" href="#atas_modal_total"><i class="fas fa-chevron-up"></i></a> 
        <a  class="btn btn-warning" href="#bawah_modal_total"><i class="fas fa-chevron-down"></i></a> 
    </div>
     
     <!-- Modal -->
     <div class="modal fade" id="modal_app_total" role="dialog" style="scroll-behavior: smooth;"> 
    <div class="modal-dialog modal-xl animate_margin" id="margin_total" style="margin:28px calc(20%)"> 
     
     
      
      <!-- Modal content-->
     <div class="modal-content animate_modal" id="content_total">
            <div class="modal-header">
              <h4 class="modal-title" id="atas_modal_total">Data <span id="title_jenis_total"></span> </h4>
              
              
              <div class="form-group" style="float:right">
                
                <button type="button" class="btn btn-tool" id="maximize_total"><i class="fas fa-expand"></i>
                  </button>
                 <button type="button" class="btn btn-tool" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i>
                  </button>  
              </div> 
              
              
               
            </div>
            <div class="modal-body">
             <div class="form-group row">
              <div class="col-lg-4">
                  <div class="form-group row" style="padding-top:10px">
                    <label for="limit" class="col-sm-2 col-form-label">Show</label>
                    <div class="col-sm-8">
                      <input type="hidden" class="form-control" id="for_total"  >
                      <input type="hidden" class="form-control" id="sum_total"  >
                      <input type="hidden" class="form-control" id="jenis_total"  >
                      <input type="hidden" class="form-control" id="w_content_total"  >
                      <select name="limit_total" id="limit_total" class="form-control"  >
                        <option value="10" selected>10</option>
                        <option value="20" >20</option>
                        <option value="30" >30</option>
                        <option value="50" >50</option>
                        <option value="100" >100</option>
                        <option value="500" >500</option>
                      </select>
                       <small>Total <span id="total_total"></span> entries</small>
                    </div>
                   
                  </div> 
              </div>
              <div class="col-lg-8">
                  <div class="form-group row" style="padding-top:10px">
                    <div class="col-sm-3">
                    </div>
                    <label for="limit" class="col-sm-1 col-form-label">Search</label>
                    <div class="col-sm-8 auto_input">
                     <input placeholder="Cari ID atau nama pelanggan" type="text" class="form-control" id="search_total"  name="search_total">
                     <div class="list-group auto" id="auto_total" style="display:none">
                        
                     </div>
                     
                    </div>
                  </div> 
              </div>
              </div>
            <div id="isi_modal_total" style="overflow-x:scroll;overflow-y:hidden;padding:0px">
              <div id="isi_width_total" style="height:1px">
              </div>
            </div >
            <div id="isi_modal2_total"  style="overflow-x:scroll;padding:0px" >
             
              <table id="get_width_total" class="table table-bordered table-hover" >
                  <thead >
                  <tr>
                    <th>No</th>
                    <th>ID Pelanggan</th>
                    <th>Nama</th>
                    <th>Tarif</th>
                    <th>Daya</th>
                    <th>Gol</th>
                    <th>Alamat</th>
                    <th>KDDK</th>
                    <th>No.HP</th>
                    <th>Rptag</th>
                    <th>RBK</th>
                    <th>Lunas?</th>
                    <th>Tgl.Lunas</th>
                  </tr>
                  </thead>
                  <tbody id="tabel_isi_total" >
                   <tr>
                      <td>No</td>
                      <td>ID Pelanggan</td>
                      <td>Nama</td>
                      <td>Tarif</td>
                      <td>Daya</td>
                      <td>Gol</td>
                      <td>Alamat</td>
                      <td>KDDK</td>
                      <td>No.HP</td>
                      <td>Rptag</td>
                      <td>RBK</td>
                      <td>Lunas?</td>
                      <td>Tgl.Lunas</td>
                  </tr>
                </table>
            </div>
            
             <div id="isi_detail_total" style="overflow-x:scroll;padding:0px;display:none">
                 <div class="form-group" style="margin-top:10px">  
                      <button id="tutup_detail_total" class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali</button>
                  </div> 
                  <table id="get_detail_width_total" class="table table-bordered table-hover" >
                    <thead >
                    <tr>
                      <th>No</th>
                      <th>ID Pelanggan</th>
                      <th>Nama</th>
                      <th>Tarif</th>
                      <th>Daya</th>
                      <th>Gol</th>
                      <th>Alamat</th>
                      <th>KDDK</th>
                      <th>No.HP</th>
                      <th>Rptag</th>
                      <th>RBK</th>
                      <th>Lunas?</th>
                      <th>Tgl.Lunas</th>
                      <th>Bulan</th>
                      <th>Tahun</th>
                      <th>Jenis Kendala</th>
                    </tr>
                    </thead>
                    <tbody id="tabel_detail_total" >
                     <tr>
                        <td>No</td>
                        <td>ID Pelanggan</td>
                        <td>Nama</td>
                        <td>Tarif</td>
                        <td>Daya</td>
                        <td>Gol</td>
                        <td>Alamat</td>
                        <td>KDDK</td>
                        <td>No.HP</td>
                        <td>Rptag</td>
                        <td>RBK</td>
                        <td>Lunas?</td>
                        <td>Tgl.Lunas</td>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Jenis Kendala</th>
                    </tr>
                  </table>
              </div>
            
            </div>
            <div class="modal-footer justify-content-between" id="bawah_modal_total">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close
              <button type="button" class="btn btn-primary" id="load_total"><i class="fas fa-sync"></i> Load Data</button>
              </div>
            </div>
            
          </div>
      
    </div>
  </div>
  
  
 
<script>
$(document).ready(function() {  
    
  //function panggil data pelanggan  
  function ajax_tusbung_total(jenis = null, limit = null, q = null) {
    if (limit == null) {
      isi_limit = 10;
    } else {
      isi_limit = limit;
    }
    
    if (q == null) {
      q_url = ""; 
    } else {
      q_url = "&q="+ q;
    }
    
     $.ajax({
			dataType: 'json',
			url: "<?php echo base_url(); ?>tusbung/petugas?id_unit=<?=$id_unit?>&total=ya&jenis="+jenis+"&limit="+ isi_limit + q_url,
			success: function(data) {
                $('#tabel_isi_total').empty();
                var no = 1;
                data.data_rows.forEach(function(data_rows) {
                    var row = '<tr>';
                    row += '<td>'+no+'</td>';
                    
                    if (data.total == null) {
                        row += '<td><a href="javascript:void(0)" id="detail_'+id_petugas+'_'+no+'"   data-id="'+data_rows.id_pelanggan+'"  >'+data_rows.id_pelanggan+'</a></td>';
                    } else {
                      row += '<td><a href="javascript:void(0)" id="detail_total_'+no+'"   data-id="'+data_rows.id_pelanggan+'"  >'+data_rows.id_pelanggan+'</a></td>';
                    } 
                        
                    row += '<td>'+data_rows.nama_pelanggan+'</td>';
                    row += '<td>'+data_rows.tarif+'</td>';
                    row += '<td>'+data_rows.daya+'</td>';
                    row += '<td>'+data_rows.gol+'</td>';
                    row += '<td>'+data_rows.alamat+'</td>';
                    row += '<td>'+data_rows.kddk+'</td>';
                    row += '<td>'+data_rows.no_hp+'</td>';
                    row += '<td style="white-space: nowrap;">'+data_rows.rptag+'</td>';
                    row += '<td>'+data_rows.rbk+'</td>';
                    
                    if (data_rows.is_lunas == 1) {
                        var lunas = "lunas";	
                    } else {
                        var lunas = "blm lunas";	
                    }
                    row += '<td>'+lunas+'</td>';
                    row += '<td>'+data_rows.tgl_lunas+'</td>';
                    row += '</tr>';
                    
                    
                    $('#tabel_isi_total').append(row);
                    
                    if (data.total == null) {
                        $("#detail_"+id_petugas+"_"+no).click(function(){
                            var id_pelanggan = $(this).data("id");
                            detail(id_pelanggan);
                        
                        })
                    } else {
                         $("#detail_total_"+no).click(function(){
                            var id_pelanggan = $(this).data("id");
                            detail(id_pelanggan);
                        })  
                    }
                    
                    
                    
                no = no + 1;
                })
                var lebar = $("#get_width_total").outerWidth();
                $("#isi_width_total").outerWidth(lebar);
                if (data.total_rows == 0) {
                    var row = '<tr>';
                    row += '<td colspan="14" class="text-center"><b>TIDAK ADA DATA</b></td>';
                    row = '</tr>';
                    $('#tabel_isi_total').append(row);
                }
                
                
			}
		});    
  } 
   
   //jquery ketika user klik detail pada id_pelanggan
  function detail(id){
      $("#isi_modal2_total").hide();
      $("#isi_detail_total").show();
      $("#auto_total").html("");
      
      $.ajax({
            dataType: 'json',
			url: "<?php echo base_url(); ?>tusbung/detail/" + id,
			success: function(data) {
                $('#tabel_detail_total').empty();
                var no = 1;
                data.data_rows.forEach(function(data_rows) {
                    var row = '<tr>';
                    row += '<td>'+no+'</td>';
                    row += '<td>'+data_rows.id_pelanggan+'</a></td>';
                    row += '<td>'+data_rows.nama_pelanggan+'</td>';
                    row += '<td>'+data_rows.tarif+'</td>';
                    row += '<td>'+data_rows.daya+'</td>';
                    row += '<td>'+data_rows.gol+'</td>';
                    row += '<td>'+data_rows.alamat+'</td>';
                    row += '<td>'+data_rows.kddk+'</td>';
                    row += '<td>'+data_rows.no_hp+'</td>';
                    row += '<td style="white-space: nowrap;">'+data_rows.rptag+'</td>';
                    row += '<td>'+data_rows.rbk+'</td>';
                    
                    if (data_rows.is_lunas == 1) {
                        var lunas = "lunas";	
                    } else {
                        var lunas = "blm lunas";	
                    }
                    row += '<td>'+lunas+'</td>';
                    row += '<td>'+data_rows.tgl_lunas+'</td>';
                    row += '<td>'+data_rows.bulan+'</td>';
                    row += '<td>'+data_rows.tahun+'</td>';
                    row += '<td>'+data_rows.nama_jenis_kendala+'</td>';
                    row += '</tr>';
                    
                    
                    $('#tabel_detail_total').append(row);
                    var lebar = $("#get_detail_width_total").outerWidth();
                    $("#isi_width_total").outerWidth(lebar);
                    $("#isi_modal_total").scroll(function(){
                        $("#isi_detail_total")
                        .scrollLeft($("#isi_modal_total").scrollLeft());
                    });
                    $("#isi_detail_total").scroll(function(){
                        $("#isi_modal_total")
                        .scrollLeft($("#isi_detail_total").scrollLeft());
                    });
                    
                no = no + 1;
                })
                if (data.total_rows == 0) {
                    var row = '<tr>';
                    row += '<td colspan="14" class="text-center"><b>TIDAK ADA DATA</b></td>';
                    row = '</tr>';
                    $('#tabel_detail_total').append(row);
                }
                
			}
		});
  }
  
  //jquery ketika user klik tutup detail
  $("#tutup_detail_total").click(function(){
    $("#isi_modal2_total, #isi_modal_total").show();
    $("#isi_detail_total").hide();
    var lebar = $("#get_width_total").outerWidth();
    $("#isi_width_total").outerWidth(lebar);
    
  })
   
  //jquery ketika user klik angka tul, lunas, dan belum lunas 
  $("#tul_total, #lunas_total, #blm_total").click(function(){
    var total = $(this).data("total");
    var sum = $(this).data("sum");
    var jenis = $(this).data("jenis");
    if (jenis == "tul") {
        var title_jenis = "Semua Pelanggan";
    } else if (jenis == "lunas") {
        var title_jenis = "Pelanggan Lunas";
    } else {
        var title_jenis = "Pelanggan Belum Lunas";
    }
    
    $("#sum_total").val(10);
    $("#jenis_total").val(jenis);
    
    $("#modal_app_total").modal();
    $("#total_total").html(sum);
    $("#search_total").val("");
    $("#auto_total").html("");
    
    $("#direction_total").fadeIn();
    ajax_tusbung_total(jenis);
    
    
    
    
    
    //ketika muncul modals pelanggan
    $("#modal_app_total").on('shown.bs.modal', function(){
        var width_content =  $("#content_total").outerWidth();
        $("#w_content_total").val(width_content); 
        
        var lebar = $("#get_width_total").outerWidth();
        $("#isi_width_total").outerWidth(lebar);
        $("#isi_modal_total").scroll(function(){
                $("#isi_modal2_total")
                .scrollLeft($("#isi_modal_total").scrollLeft());
        });
        $("#isi_modal2_total").scroll(function(){
                $("#isi_modal_total")
                .scrollLeft($("#isi_modal2_total").scrollLeft());
        });
        
         
        
    });
    
   
    //ketika modals pelanggan ditutup
    $("#modal_app_total").on('hide.bs.modal', function(){
        $("#direction_total").fadeOut();
        var width_content =  $("#w_content_total").val();
        $("#content_total").width(width_content);
        $("#margin_total").css("margin", "28px calc(20%)"); 
        open = 0;
        $("#limit_total").val(10);
         
        $("#isi_modal2_total, #isi_modal_total").show();
        $("#isi_detail_total").hide(); 
        
    });
   
    
  }); 
  var open = 0;
  
  
  //jquery ketika user klik maximize di modals pelanggan
  $("#maximize_total").click(function(){
    
    if (open == 0) {
      var window_width = $(window).width();
      var dikurang = parseInt(window_width - 20);
      
      $("#content_total").css("width", dikurang+"px");
      $("#margin_total").css("margin", "0 10px 0 0"); 
      
      open = 1;
    } else {
      var width_content =  $("#w_content_total").val();
      $("#w_content_total").val(width_content); 
      $("#content_total").outerWidth(width_content);
      $("#content_total").css("width", width_content+"px");
      $("#margin_total").css("margin", "28px calc(20%)"); 
      open = 0;
    }  
  }); 
  
  //jquery ketika user pilih limit data
  $("#limit_total").change(function(){
    var limit =  $("#limit_total").val();
    var jenis =  $("#jenis_total").val();
    $("#sum_total").val(limit);
    $("#modal_app_total").modal();
    ajax_tusbung_total(jenis, limit)
    $("#isi_modal2_total, #isi_modal_total").show();
    $("#isi_detail_total").hide(); 
    
  }); 

  //jquery ketika user klik load data
  var jumlah = 0;
  $("#load_total").click(function(){
    var limit =  parseInt($("#limit_total").val());
    var jenis =  $("#jenis_total").val();
    jumlah =  parseInt($("#sum_total").val());
    var sum = jumlah + limit;
    $("#sum_total").val(sum);
    $("#modal_app_total").modal();
    ajax_tusbung_total(jenis, sum)
    $("#isi_modal2_total, #isi_modal_total").show();
    $("#isi_detail_total").hide(); 
    
    
  }); 
  
  //jquery ketika user ketik di input search
  $("#search_total").keyup(function(){
    $("#isi_modal2_total, #isi_modal_total").show();
    $("#isi_detail_total").hide(); 
    
    
    var search =  $("#search_total").val();
    var jenis =  $("#jenis_total").val();
    if (search == "") {
      $("#auto_total").css("display", "none");
      $("#auto_total").html("");
      ajax_tusbung_total(jenis)
    } else {
      $("#auto_total").css("display", "flex");
      $.ajax({
            dataType: 'json',
			url: "<?php echo base_url(); ?>tusbung/search?id_unit=<?=$id_unit?>&total=ya&jenis="+jenis+"&q="+ search,
			success: function(data) {
                $('#auto_total').empty();
                var no = 1;
                data.data_rows.forEach(function(data_rows) {
                    var row = '<a href="javascript:void(0)" class="list-group-item" id="auto_li_total_'+no+'" data-id="'+data_rows.id_pelanggan+'">';
                     row += data_rows.id_pelanggan+' '+data_rows.nama_pelanggan;
                     row += '</a>';
                    $('#auto_total').append(row);
                    
                    
                    $("#auto_li_total_"+no).click(function(){
                        var isi_auto =  $(this).data("id");
                        var id_petugas =  data.id_petugas;
                        $("#search_total").val(isi_auto);
                        $("#auto_total").css("display", "none");
                        ajax_tusbung_total( jenis, null, isi_auto)
                    })
                no = no + 1;
                })
                if (data.total_rows == 0) {
                   var row = '<a href="javascript:void(0)" class="list-group-item">Data tidak ditemukan!!</a>';
                    $('#auto_total').append(row);
                }
                
			}
		});
      
      
      
      
    }
    
  }); 
  
  
  
})
</script>
 
 
 
 <?php } ?>
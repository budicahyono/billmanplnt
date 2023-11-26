<!-- Tusbung Custom Javascript -->

<?php $no=1; 
 if (menu('child') == "Tusbung") {   
 
 // Data Petugas ================================================================== 
 ?>   
     <div class="form-group direction"  style="position:fixed;bottom:1px;right:152px;z-index:1051;display:none;">
        <a  class="btn btn-warning atas_modal" ><i class="fas fa-chevron-up"></i></a> 
        <a  class="btn btn-warning bawah_modal" ><i class="fas fa-chevron-down"></i></a> 
    </div> 
    
    
    
     <!-- Modal -->
     <div class="modal fade modal_app"  role="dialog" style="scroll-behavior: smooth;" > 
    <div class="modal-dialog modal-xl animate_margin width_margin" > 
     
     
      
      <!-- Modal content-->
     <div class="modal-content animate_modal width_content" >
            <div class="modal-header">
              <h4 class="modal-title" >Data <span class="title_jenis"></span> <span style="text-transform: capitalize;" class="title_modal"></span></h4>
              
              
              <div class="form-group" style="float:right">
                
                <button type="button" class="btn btn-tool maximize" ><i class="fas fa-expand"></i>
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
                      <select  class="form-control limit">
                        <option value="10" selected>10</option>
                        <option value="20" >20</option>
                        <option value="30" >30</option>
                        <option value="50" >50</option>
                        <option value="100" >100</option>
                        <option value="500" >500</option>
                      </select>
                       <small>Total <span class="total"></span> entries</small>
                    </div>
                   
                  </div> 
              </div>
              <div class="col-lg-8">
                  <div class="form-group row" style="padding-top:10px">
                    <div class="col-sm-3">
                    </div>
                    <label for="limit" class="col-sm-1 col-form-label">Search</label>
                    <div class="col-sm-8 auto_input">
                     <input placeholder="Cari ID atau nama pelanggan" type="text" class="form-control search"  name="search">
                     <div class="list-group auto"  style="display:none">
                        
                     </div>
                     
                    </div>
                  </div> 
              </div>
              </div>
              <div class="isi_modal" style="overflow-x:scroll;overflow-y:hidden;padding:0px">
                <div class="isi_width" style="height:1px">
                </div>
              </div >
              <div class="isi_modal2"  style="overflow-x:scroll;padding:0px" >
               
                <table  class="get_width table table-bordered table-hover" >
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
                      <th>Jenis Kendala</th>
                      <th>Nama Petugas</th>
                    </tr>
                    </thead>
                    <tbody class="tabel_isi" >
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
                        <td>Jenis Kendala</td>
                        <th>Nama Petugas</th>
                    </tr>
                  </table>
              </div>
              
              <div class="isi_detail" style="overflow-x:scroll;padding:0px;display:none">
                  <div class="form-group" style="margin-top:10px">
                      <button class="btn btn-info tutup_detail"><i class="fa fa-arrow-left"></i> Kembali</button>
                  </div>
                  <table  class="table table-bordered table-hover get_detail_width" >
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
                      <th>Nama Petugas</th>
                    </tr>
                    </thead>
                    <tbody class="tabel_detail" >
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
                        <th>Nama Petugas</th>
                    </tr>
                  </table>
              </div>
              
            </div>
            <div class="modal-footer justify-content-between " >
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close
              <button type="button" class="btn btn-primary load" ><i class="fas fa-sync"></i> Load Data</button>
              </div>
            </div>
            
          </div>
      
    </div>
  
  
 
<script>
$(document).ready(function() {  
  
  $(".atas_modal").on("click", function() {
    $(".modal").scrollTop(0);
  }); 
  
  $(".bawah_modal").on("click", function() {
    $(".modal").scrollTop($(".width_content").height());
  });
  
  
  //function panggil data pelanggan  
  function ajax_tusbung(id_petugas, jenis = null, total, limit = null, q = null) {
    if (limit == null) {
      isi_limit = 10;
    } else {
      isi_limit = limit;
    }
    var q_url = "";
    
    if (q != null) {
       q_url = "&q="+ q;
    } 
    
    
    
    $.ajax({
			dataType: 'json',
			url: "<?php echo base_url(); ?>tusbung/petugas/" + id_petugas + "?id_unit=<?=$id_unit?>&total="+total+"&jenis="+jenis+"&limit="+ isi_limit + q_url,
			success: function(data) {
                $('.tabel_isi').empty();
                var no = 1;
                data.data_rows.forEach(function(data_rows) {
                    var row = '<tr>';
                    row += '<td>'+no+'</td>';
                    
                    
                    row += '<td><a href="javascript:void(0)" class="detail"   data-id="'+data_rows.id_pelanggan+'"  >'+data_rows.id_pelanggan+'</a></td>';
                    
                        
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
                    row += '<td>'+data_rows.nama_jenis_kendala+'</td>';
                    row += '<td>'+data_rows.nama_petugas+'</td>';
                    row += '</tr>';
                    
                    
                    $('.tabel_isi').append(row);
                    
                    $(".detail").click(function(){
                        var id_pelanggan = $(this).data("id");
                        detail(id_pelanggan);
                    
                    })
                    
                    
                    
                no = no + 1;
                })
                var lebar = $(".get_width").outerWidth();
                $(".isi_width").outerWidth(lebar);
                if (data.total_rows == 0) {
                    var row = '<tr>';
                    row += '<td colspan="14" class="text-center"><b>TIDAK ADA DATA</b></td>';
                    row = '</tr>';
                    $('.tabel_isi').append(row);
                }
                
                
			}
		});    
  }
  
  //function ketika user klik detail pada id_pelanggan
  function detail(id){
      $(".isi_modal2").hide();
      $(".isi_detail").show();
      $(".auto").html("");
      
      $.ajax({
            dataType: 'json',
			url: "<?php echo base_url(); ?>tusbung/detail/" + id,
			success: function(data) {
                $('.tabel_detail').empty();
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
                    row += '<td>'+data_rows.nama_petugas+'</td>';
                    row += '</tr>';
                    
                    
                    $('.tabel_detail').append(row);
                    var lebar = $(".get_detail_width").outerWidth();
                    $(".isi_width").outerWidth(lebar);
                    $(".isi_modal").scroll(function(){
                        $(".isi_detail")
                        .scrollLeft($(".isi_modal").scrollLeft());
                    });
                    $(".isi_detail").scroll(function(){
                        $(".isi_modal")
                        .scrollLeft($(".isi_detail").scrollLeft());
                    });
                    
                no = no + 1;
                })
                if (data.total_rows == 0) {
                    var row = '<tr>';
                    row += '<td colspan="14" class="text-center"><b>TIDAK ADA DATA</b></td>';
                    row = '</tr>';
                    $('.tabel_detail').append(row);
                }
                
			}
		});
  }
  
  //jquery ketika user klik tutup detail
  $(".tutup_detail").click(function(){
    $(".isi_modal2, .isi_modal").show();
    $(".isi_detail").hide();
    var lebar = $(".get_width").outerWidth();
    $(".isi_width").outerWidth(lebar);
    
  })
   
  //jquery ketika user klik angka tul, lunas, dan belum lunas 
  $(".tul, .lunas, .blm").click(function(){
    
    if ($(this).attr("name") != null && $(this).attr("id") != null) { 
        var nama_petugas = $(this).attr("name");
        var id_petugas = $(this).attr("id");
        sessionStorage.setItem("nama_petugas", nama_petugas);
        var nama = nama_petugas.toLowerCase();
        $(".title_modal").html("Berdasarkan Petugas <b>"+nama+"</b>");
    } else {
        var id_petugas = null;
        $(".title_modal").html("");
    }
    
    var sum = $(this).attr("sum");
    var jenis = $(this).attr("jenis");
    
    if ($(this).attr("total") != null) {
        var total = $(this).attr("total");
    } else {
        var total = "no";
    }
    
    if (jenis == "tul") {
        var title_jenis = "Semua Pelanggan";
    } else if (jenis == "lunas") {
        var title_jenis = "Pelanggan Lunas";
    } else {
        var title_jenis = "Pelanggan Belum Lunas";
    }
    
    
    sessionStorage.setItem("total", total);
    sessionStorage.setItem("id_petugas", id_petugas);
    sessionStorage.setItem("sum", 10);
    sessionStorage.setItem("limit", 10);
    sessionStorage.setItem("jenis", jenis);
   
    
    
    $(".modal_app").modal();
    
    $(".title_jenis").html(title_jenis);
    $(".total").html(sum);
    $(".search").val("");
    $(".auto").html("");
    
    $(".direction").fadeIn();
    ajax_tusbung(id_petugas, jenis, total);
    
    
    
    
    
    //ketika muncul modals pelanggan
    $(".modal_app").on('shown.bs.modal', function(){
        var width_content =  $(".width_content").width();
        sessionStorage.setItem("width_content", width_content);
        
        
        var lebar = $(".get_width").width();
        $(".isi_width").width(lebar);
        $(".isi_modal").scroll(function(){
                $(".isi_modal2")
                .scrollLeft($(".isi_modal").scrollLeft());
        });
        $(".isi_modal2").scroll(function(){
                $(".isi_modal")
                .scrollLeft($(".isi_modal2").scrollLeft());
        });
        
         
        
    });
    
   
    //ketika modals pelanggan ditutup
    $(".modal_app").on('hide.bs.modal', function(){
        $(".direction").fadeOut();
        var width_content = sessionStorage.getItem("width_content");
        
        $(".width_content").width(width_content);
        $(".width_margin").css("margin", "28px calc(20%)"); 
        open = 0;
        $(".limit").val(10); 
        sessionStorage.setItem("sum", 10);
        $(".isi_modal2, .isi_modal").show();
        $(".isi_detail").hide(); 
        
    });
   
    
  }); 
  var open = 0;
  
  
  //jquery ketika user klik maximize di modals pelanggan
  $(".maximize").click(function(){
    
    if (open == 0) {
      var window_width = $(window).width();
      var dikurang = parseInt(window_width - 20);
      
      $(".width_content").css("width", dikurang+"px");
      $(".width_margin").css("margin", "0 10px 0 0"); 
      
      open = 1;
    } else {
      var width_content = sessionStorage.getItem("width_content");
      
      
      $(".width_content").width(width_content);
      $(".width_margin").css("margin", "28px calc(20%)"); 
      open = 0; 
    }  
  }); 
  
  //jquery ketika user pilih limit data
  $(".limit").change(function(){
    var id_petugas  = sessionStorage.getItem("id_petugas");
    var limit       =  $(".limit").val();
    sessionStorage.setItem("limit", limit);
    sessionStorage.setItem("sum", limit);
    var jenis       = sessionStorage.getItem("jenis");
    var total       = sessionStorage.getItem("total");
    $(".modal_app").modal();
    ajax_tusbung(id_petugas, jenis, total, limit)
    $(".isi_modal2, .isi_modal").show();
    $(".isi_detail").hide(); 
    
  }); 

  //jquery ketika user klik load data
  var jumlah = 0;
  $(".load").click(function(){
    var id_petugas  = sessionStorage.getItem("id_petugas");
    var limit       = parseInt(sessionStorage.getItem("limit"));
    var jenis       = sessionStorage.getItem("jenis");
    var total       = sessionStorage.getItem("total");
    var sum         = parseInt(sessionStorage.getItem("sum"));
    jumlah   = sum + limit;
    
    $(".modal_app").modal();
    ajax_tusbung(id_petugas, jenis, total, jumlah)
    $(".isi_modal2, .isi_modal").show();
    $(".isi_detail").hide(); 
    sessionStorage.setItem("sum", jumlah);
    
  }); 
  
  //jquery ketika user ketik di input search
  $(".search").keyup(function(){
    $(".isi_modal2, .isi_modal").show();
    $(".isi_detail").hide(); 
    
    
    var search =  $(".search").val();
    var id_petugas  = sessionStorage.getItem("id_petugas");
    var jenis       = sessionStorage.getItem("jenis");
    var total       = sessionStorage.getItem("total");
    if (search == "") {
      $(".auto").css("display", "none");
      $(".auto").html("");
      ajax_tusbung(id_petugas, jenis, total)
    } else {
      $(".auto").css("display", "flex");
      $.ajax({
            dataType: 'json',
			url: "<?php echo base_url(); ?>tusbung/search/" + id_petugas + "?id_unit=<?=$id_unit?>&total="+total+"&jenis="+jenis+"&q="+ search,
			success: function(data) {
                $('.auto').empty();
                var no = 1;
                data.data_rows.forEach(function(data_rows) {
                    var row = '<a href="javascript:void(0)" class="list-group-item auto_li"  data-id="'+data_rows.id_pelanggan+'">';
                     row += data_rows.id_pelanggan+' '+data_rows.nama_pelanggan;
                     row += '</a>';
                    $('.auto').append(row);
                    
                    
                    $(".auto_li").click(function(){
                        var isi_auto =  $(this).data("id");
                        $(".search").val(isi_auto);
                        $(".auto").css("display", "none");
                        ajax_tusbung(id_petugas, jenis, total, null, isi_auto)
                    })
                no = no + 1;
                })
                if (data.total_rows == 0) {
                   var row = '<a href="javascript:void(0)" class="list-group-item auto_no">Data tidak ditemukan!!</a>';
                    $('.auto').append(row);
                    
                    $(".auto_no").click(function(){
                        $(".search").val("");
                        $(".auto").css("display", "none");
                        ajax_tusbung(id_petugas, jenis, total)
                    })
                }
                
			}
		});
      
      
      
      
    }
    
  }); 
  
  
})
</script>
 <?php } ?>
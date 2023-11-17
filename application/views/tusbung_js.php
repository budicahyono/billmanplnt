<!-- Tusbung Custom Javascript -->


<?php $no=1; 
 if (menu('child') == "Tusbung") {   
     foreach ($petugas->result() as $r) { ?>   
     
    <div class="form-group" id="direction_<?=$no?>" style="position:fixed;bottom:1px;right:152px;z-index:1051;display:none;">
         <a  class="btn btn-warning" href="#atas_modal_<?=$no?>"><i class="fas fa-chevron-up"></i></a> 
        <a  class="btn btn-warning" href="#bawah_modal_<?=$no?>"><i class="fas fa-chevron-down"></i></a> 
    </div>
     
     <!-- Modal -->
     <div class="modal fade" id="modal_app_<?=$no?>" role="dialog" style="scroll-behavior: smooth;"> 
    <div class="modal-dialog modal-xl animate_margin" id="margin_<?=$no?>" style="margin:28px calc(20%)"> 
     
     
      
      <!-- Modal content-->
     <div class="modal-content animate_modal" id="content_<?=$no?>">
            <div class="modal-header">
              <h4 class="modal-title" id="atas_modal_<?=$no?>">Data Pelanggan Berdasarkan Petugas <span style="text-transform: capitalize;" id="title_modal_<?=$no?>"></span></h4>
              
              
              <div class="form-group" style="float:right">
                
                <button type="button" class="btn btn-tool" id="maximize_<?=$no?>"><i class="fas fa-expand"></i>
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
                      <input type="hidden" class="form-control" id="id_petugas_<?=$no?>"  >
                      <input type="hidden" class="form-control" id="no_list_<?=$no?>"  >
                      <input type="hidden" class="form-control" id="sum_<?=$no?>"  >
                      <input type="hidden" class="form-control" id="w_content_<?=$no?>"  >
                      <select name="limit_<?=$no?>" id="limit_<?=$no?>" class="form-control"  >
                        <option value="10" selected>10</option>
                        <option value="20" >20</option>
                        <option value="30" >30</option>
                        <option value="50" >50</option>
                        <option value="100" >100</option>
                        <option value="500" >500</option>
                      </select>
                       <small>Total <span id="total_<?=$no?>"></span> entries</small>
                    </div>
                   
                  </div> 
              </div>
              <div class="col-lg-8">
                  <div class="form-group row" style="padding-top:10px">
                    <div class="col-sm-3">
                    </div>
                    <label for="limit" class="col-sm-1 col-form-label">Search</label>
                    <div class="col-sm-8 auto_input">
                     <input placeholder="Cari ID atau nama pelanggan" type="text" class="form-control" id="search_<?=$no?>"  name="search_<?=$no?>">
                     <div class="list-group auto" id="auto_<?=$no?>" style="display:none">
                        
                     </div>
                     
                    </div>
                  </div> 
              </div>
              </div>
            <div id="isi_modal_<?=$no?>" style="overflow-x:scroll;overflow-y:hidden;padding:0px">
              <div id="isi_width_<?=$no?>" style="height:1px">
              </div>
            </div >
            <div id="isi_modal2_<?=$no?>"  style="overflow-x:scroll;padding:0px" >
             
              <table id="get_width_<?=$no?>" class="table table-bordered table-hover" >
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
                  <tbody id="tabel_isi_<?=$no?>" >
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
            </div>
            <div class="modal-footer justify-content-between" id="bawah_modal_<?=$no?>">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close
              <button type="button" class="btn btn-primary" id="load_<?=$no?>"><i class="fas fa-sync"></i> Load Data</button>
              </div>
            </div>
            
          </div>
      
    </div>
  </div>
  
  
  <!--  javascript klik nama_petugas utk tusbung_kumulatif per petugas -->
<script>

$(document).ready(function() {  
  function ajax_tusbung(id_petugas, limit = null, q = null) {
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
			type: 'GET',
			url: "<?php echo base_url(); ?>tusbung/petugas/" + id_petugas + "?id_unit=<?=$id_unit?>&limit="+ isi_limit + q_url,
			success: function(data) {
				$("#tabel_isi_<?=$no?>").html(data);
                 
			}
		});    
  } 
   
   
  $("#nama_petugas_<?=$no?>, #tul_<?=$no?>").click(function(){
    var nama_petugas = $(this).data("name");
    var id_petugas = $(this).data("id");
    var sum = $(this).data("sum");
    $("#id_petugas_<?=$no?>").val(id_petugas);
    $("#no_list_<?=$no?>").val(<?=$no?>);
    $("#sum_<?=$no?>").val(10);
    var nama = nama_petugas.toLowerCase();
    $("#modal_app_<?=$no?>").modal();
    $("#title_modal_<?=$no?>").html(nama);
    $("#total_<?=$no?>").html(sum);
    $("#direction_<?=$no?>").fadeIn();
    ajax_tusbung(id_petugas);
    
    
    
    
    
    
    $("#modal_app_<?=$no?>").on('shown.bs.modal', function(){
        var width_content =  $("#content_<?=$no?>").outerWidth();
        $("#w_content_<?=$no?>").val(width_content); 
        
        var lebar = $("#get_width_<?=$no?>").outerWidth();
        $("#isi_width_<?=$no?>").outerWidth(lebar);
        $("#isi_modal_<?=$no?>").scroll(function(){
            $("#isi_modal2_<?=$no?>")
                .scrollLeft($("#isi_modal_<?=$no?>").scrollLeft());
        });
        $("#isi_modal2_<?=$no?>").scroll(function(){
            $("#isi_modal_<?=$no?>")
                .scrollLeft($("#isi_modal2_<?=$no?>").scrollLeft());
        });
        $("#search_<?=$no?>").val("")
        
         
        
    });
    
   
    
    $("#modal_app_<?=$no?>").on('hide.bs.modal', function(){
        $("#direction_<?=$no?>").fadeOut();
        var width_content =  $("#w_content_<?=$no?>").val();
        $("#content_<?=$no?>").width(width_content);
        $("#margin_<?=$no?>").css("margin", "28px calc(20%)"); 
        open = 0;
    });
   
    
  }); 
  var open = 0;
  
  $("#maximize_<?=$no?>").click(function(){
    
    if (open == 0) {
      var window_width = $(window).width();
      var dikurang = parseInt(window_width - 20);
      
      $("#content_<?=$no?>").css("width", dikurang+"px");
      $("#margin_<?=$no?>").css("margin", "0 10px 0 0"); 
      
      open = 1;
    } else {
      var width_content =  $("#w_content_<?=$no?>").val();
      $("#w_content_<?=$no?>").val(width_content); 
      $("#content_<?=$no?>").outerWidth(width_content);
      $("#content_<?=$no?>").css("width", width_content+"px");
      $("#margin_<?=$no?>").css("margin", "28px calc(20%)"); 
      open = 0;
    }  
  }); 
  
  
  $("#limit_<?=$no?>").change(function(){
    var id_petugas = $("#id_petugas_<?=$no?>").val();
    var limit =  $("#limit_<?=$no?>").val();
    $("#sum_<?=$no?>").val(limit);
    $("#modal_app_<?=$no?>").modal();
    ajax_tusbung(id_petugas, limit)
  }); 

  
  var jumlah = 0;
  $("#load_<?=$no?>").click(function(){
    var id_petugas = $("#id_petugas_<?=$no?>").val();
    var limit =  parseInt($("#limit_<?=$no?>").val());
    jumlah =  parseInt($("#sum_<?=$no?>").val());
    var sum = jumlah + limit;
    $("#sum_<?=$no?>").val(sum);
    $("#modal_app_<?=$no?>").modal();
    ajax_tusbung(id_petugas, sum)
    
  }); 
  
  $("#search_<?=$no?>").keyup(function(){
    var search =  $("#search_<?=$no?>").val();
    var id_petugas = $("#id_petugas_<?=$no?>").val();
    var no_list = $("#no_list_<?=$no?>").val();
    if (search == "") {
      $("#auto_<?=$no?>").css("display", "none");
      $("#auto_<?=$no?>").html("");
      ajax_tusbung(id_petugas)
    } else {
      $("#auto_<?=$no?>").css("display", "flex");
      $.ajax({
            dataType: 'json',
			url: "<?php echo base_url(); ?>tusbung/search/" + id_petugas + "?id_unit=<?=$id_unit?>&q="+ search+"&no="+no_list,
			success: function(data) {
				//$("#auto_<?=$no?>").html(data);
                $('#auto_<?=$no?>').empty();
                var no = 1;
                data.data_rows.forEach(function(data_rows) {
                    var row = '<a href="javascript:void(0)" class="list-group-item" id="auto_li_'+no+'" data-id="'+data_rows.id_pelanggan+'">';
                     row += data_rows.id_pelanggan+' '+data_rows.nama_pelanggan;
                     row += '</a>';
                    $('#auto_<?=$no?>').append(row);
                    
                    
                    $("#auto_li_"+no).click(function(){
                        var isi_auto =  $(this).data("id");
                        var id_petugas =  data.id_petugas;
                        $("#search_<?=$no?>").val(isi_auto);
                        $("#auto_<?=$no?>").css("display", "none");
                        ajax_tusbung(id_petugas, null, isi_auto)
                    })
                no = no + 1;
                })    
                
			}
		});
      
      
      
      
    }
    
  }); 
  
  
})
</script>
<script>
 
  </script>
    
 <?php $no = $no+ 1;}} ?>
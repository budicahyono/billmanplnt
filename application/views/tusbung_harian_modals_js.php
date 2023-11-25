<!-- Tusbung Custom Javascript -->

<?php $no=1; 
 if (menu('child') == "Tusbung Harian") {   
 
 // Data Petugas ================================================================== 
     foreach ($petugas->result() as $r) {
	 $id = $r->id_petugas;	  
	?>   
	
	<!-- Modal -->
     <div class="modal fade" id="modal_edit_<?=$id?>" role="dialog" > 
    <div class="modal-dialog modal-xl " id="margin_<?=$id?>" > 	
      
      <!-- Modal Edit-->
     <div class="modal-content animate_modal" id="content_edit_<?=$id?>">
            <div class="modal-header">
              <h4 class="modal-title" id="atas_modal_<?=$id?>">Edit Kendala Harian Berdasarkan Petugas <span style="text-transform: capitalize;font-weight:bold" id="title_modal_<?=$id?>"></span></h4>
              
              
              <div class="form-group" style="float:right">
                
                
                 <button type="button" class="btn btn-tool" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i>
                  </button>  
              </div> 
              
              
               
            </div>
            <div class="modal-body">
             <div class="form-group">
                <label>Apa Kendala Hari Ini?</label>
                <input  required name="kendala_harian_<?=$id?>" id="kendala_harian_<?=$id?>" type="text" class="form-control" >
                <input value="<?=$id?>" required name="id_petugas_kendala_<?=$id?>" id="id_petugas_kendala_<?=$id?>" type="hidden"  >
                <input  required name="tgl_<?=$id?>" id="tgl_<?=$id?>" type="hidden"  >
                <input  required name="id_kendala_harian_<?=$id?>" id="id_kendala_harian_<?=$id?>" type="hidden"  >
                </div>
              
              
            </div>
            <div class="modal-footer justify-content-between" id="bawah_modal_<?=$id?>">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
			  <button id="post_kendala_<?=$id?>" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
              </div>
            </div>
            
          </div>
      
    </div>
  
  
 
<script>
$(document).ready(function() {  
    
   
  //jquery ketika user klik edit kendala
  $("#edit_kendala_<?=$id?>, #save_kendala_<?=$id?>").click(function(){
    var nama_petugas = $(this).data("name");
    var id_petugas = $(this).data("id");
    if ($(this).data("edit") != null) {
        var id_kendala_harian = $(this).data("edit");
        $("#id_kendala_harian_<?=$id?>").val(id_kendala_harian);
    } else {
        $("#id_kendala_harian_<?=$id?>").val(0);
    }
     if ($(this).data("isi") != null) {
        var isi_kendala = $(this).data("isi");
        $("#kendala_harian_<?=$id?>").val(isi_kendala);
    } else {
        $("#kendala_harian_<?=$id?>").val("");
    }
    var id_petugas = $(this).data("edit");
    var tgl = $("#tanggal_harian").val();
    
    $("#id_petugas_<?=$id?>").val(id_petugas);
    $("#tgl_<?=$id?>").val(tgl);
    
    
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
  $("#post_kendala_<?=$id?>").click(function(){
	var kendala_harian = $("#kendala_harian_<?=$id?>").val(); 
	var id_petugas_kendala = $("#id_petugas_kendala_<?=$id?>").val(); 
	var id_kendala_harian = $("#id_kendala_harian_<?=$id?>").val(); 
	var tgl = $("#tgl_<?=$id?>").val(); 
    
    if (id_kendala_harian == 0) {
        var isi_data =  {kendala_harian:kendala_harian, 
                         id_petugas_kendala:id_petugas_kendala,
                         tgl:tgl};
        var isi_url  =  "<?php echo base_url(); ?>tusbung_harian/save";              
    } else {
        var isi_data =  {kendala_harian:kendala_harian, 
                         id_petugas_kendala:id_petugas_kendala,
                         tgl:tgl,
                         id_kendala_harian:id_kendala_harian};
        var isi_url  =  "<?php echo base_url(); ?>tusbung_harian/edit";                 
    }
	$.ajax({
        type: 'POST',
            data: isi_data,
            url: isi_url,
        success: function(data) {
            window.location.replace("<?=base_url()?>tusbung_harian");    
            
        }
    });
      
  
  })
  
  

  
  
})
</script>
    
 <?php $no = $no+ 1;} 
 
 // Data Petugas Khusus ================================================================== 
 
 foreach ($petugas_khusus->result() as $r) { $id = $r->id_petugas;	
 ?>
 <!-- Modal -->
     <div class="modal fade" id="modal_edit_<?=$id?>" role="dialog" > 
    <div class="modal-dialog modal-xl " id="margin_<?=$id?>" > 	
      
      <!-- Modal Edit-->
     <div class="modal-content animate_modal" id="content_edit_<?=$id?>">
            <div class="modal-header">
              <h4 class="modal-title" id="atas_modal_<?=$id?>">Edit Kendala Harian Berdasarkan Petugas <span style="text-transform: capitalize;font-weight:bold" id="title_modal_<?=$id?>"></span></h4>
              
              
              <div class="form-group" style="float:right">
                
                
                 <button type="button" class="btn btn-tool" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i>
                  </button>  
              </div> 
              
              
               
            </div>
            <div class="modal-body">
             <div class="form-group">
                <label>Apa Kendala Hari Ini?</label>
                <input  required name="kendala_harian_<?=$id?>" id="kendala_harian_<?=$id?>" type="text" class="form-control" >
                <input value="<?=$id?>" required name="id_petugas_kendala_<?=$id?>" id="id_petugas_kendala_<?=$id?>" type="hidden"  >
                <input  required name="tgl_<?=$id?>" id="tgl_<?=$id?>" type="hidden"  >
                <input  required name="id_kendala_harian_<?=$id?>" id="id_kendala_harian_<?=$id?>" type="hidden"  >
                </div>
              
              
            </div>
            <div class="modal-footer justify-content-between" id="bawah_modal_<?=$id?>">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
			  <button id="post_kendala_<?=$id?>" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
              </div>
            </div>
            
          </div>
      
    </div>
  
  
 
<script>
$(document).ready(function() {  
    
   
  //jquery ketika user klik edit kendala
  $("#edit_kendala_<?=$id?>, #save_kendala_<?=$id?>").click(function(){
    var nama_petugas = $(this).data("name");
    var id_petugas = $(this).data("id");
    if ($(this).data("edit") != null) {
        var id_kendala_harian = $(this).data("edit");
        $("#id_kendala_harian_<?=$id?>").val(id_kendala_harian);
    } else {
        $("#id_kendala_harian_<?=$id?>").val(0);
    }
     if ($(this).data("isi") != null) {
        var isi_kendala = $(this).data("isi");
        $("#kendala_harian_<?=$id?>").val(isi_kendala);
    } else {
        $("#kendala_harian_<?=$id?>").val("");
    }
    var id_petugas = $(this).data("edit");
    var tgl = $("#tanggal_harian").val();
    
    $("#id_petugas_<?=$id?>").val(id_petugas);
    $("#tgl_<?=$id?>").val(tgl);
    
    
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
  $("#post_kendala_<?=$id?>").click(function(){
	var kendala_harian = $("#kendala_harian_<?=$id?>").val(); 
	var id_petugas_kendala = $("#id_petugas_kendala_<?=$id?>").val(); 
	var id_kendala_harian = $("#id_kendala_harian_<?=$id?>").val(); 
	var tgl = $("#tgl_<?=$id?>").val(); 
    
    if (id_kendala_harian == 0) {
        var isi_data =  {kendala_harian:kendala_harian, 
                         id_petugas_kendala:id_petugas_kendala,
                         tgl:tgl};
        var isi_url  =  "<?php echo base_url(); ?>tusbung_harian/save";              
    } else {
        var isi_data =  {kendala_harian:kendala_harian, 
                         id_petugas_kendala:id_petugas_kendala,
                         tgl:tgl,
                         id_kendala_harian:id_kendala_harian};
        var isi_url  =  "<?php echo base_url(); ?>tusbung_harian/edit";                 
    }
	$.ajax({
        type: 'POST',
            data: isi_data,
            url: isi_url,
        success: function(data) {
            window.location.replace("<?=base_url()?>tusbung_harian");    
            
        }
    });
      
  
  })
  
  

  
  
})
</script>
 
  
 
 
 <?php } } ?>
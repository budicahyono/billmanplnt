<?php 
$no = 1;
foreach ($tusbung->result() as $r) { ?>
	<a href="javascript:void(0)" class="list-group-item" id="auto_li_<?=$no?>" data-id="<?=$r->id_pelanggan?>"><?=$r->id_pelanggan.' '.$r->nama_pelanggan?></a>
	


<script>
	$("#auto_li_<?=$no?>").click(function(){
          var isi_auto =  $(this).data("id");
          var limit =  <?=$limit?>;
          var id_petugas =  <?=$id_petugas?>;
          $("#search_<?=$no_list?>").val(isi_auto);
          $("#auto_<?=$no_list?>").css("display", "none");
		  
      })
</script>	

<?php $no = $no + 1;} ?>
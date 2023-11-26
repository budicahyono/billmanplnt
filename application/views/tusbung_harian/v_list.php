<tr>
	<td><?=$no?></td>
	<td style="width:200px"><?=$r['nama_petugas']?> <?=($r['is_petugas_khusus']== 1) ? $r['text_khusus'] : ""?></td>
	
	 <td><a href="javascript:void(0)" class="tul" name="<?=$r['nama_petugas']?>" id="<?=$r['id_petugas']?>" sum="<?=$r['sum_tul']?>" jenis="tul" ><?=$r['sum_tul']?></td>
	<td><?=rp($r['sum_tul_rp'])?></td>
	
	<td><a href="javascript:void(0)" class="lunas" name="<?=$r['nama_petugas']?>" id="<?=$r['id_petugas']?>" sum="<?=$r['sum_lunas']?>" jenis="lunas" ><?=$r['sum_lunas']?></td>
	<td><?=rp($r['sum_lunas_rp'])?></td>
	
	<td><?=$r['persen_tul']?>%</td>
	<td><?=$r['persen_tul_rp']?>%</td>
	
	<td><?=$r['sum_evidence']?></td>
	<td><?=$r['persen_evidence']?>%</td>
	<td><?=$r['sisa_evidence']?></td>
	<td>
	<?php 
	if ($r['sisa_evidence'] > 0) {
	  echo $r['text_kendala'];
	  if ($r['isi_kendala'] == "") { ?>
	<a  href="javascript:void(0)"  id="<?=$r['id_petugas']?>" name="<?=$r['nama_petugas']?>" edit="null" class="btn btn-danger save_kendala" style="margin-left:10px"><i class="fa fa-edit"></i></a>   
	
	<?php } else { ?>
	<a  href="javascript:void(0)"  id="<?=$r['id_petugas']?>" name="<?=$r['nama_petugas']?>" edit="<?=$r['id_kendala_harian']?>" class="btn btn-default edit_kendala" style="margin-left:10px"><i class="fa fa-edit"></i></a>   
	
	<?php }
	} ?>
	</td>
</tr>
<?php 
	$total_tul 		= $total_tul 		+ $r['sum_tul'];
	$total_rp 		= $total_rp 		+ $r['sum_tul_rp'];
	$total_lunas 	= $total_lunas 		+ $r['sum_lunas'];
	$total_lunas_rp = $total_lunas 		+ $r['sum_lunas_rp'];
	$total_evidence = $total_evidence 	+ $r['sum_evidence'];
	$total_sisa 	= $total_sisa 	 	+ $r['sisa_evidence'];


?>

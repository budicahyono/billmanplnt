<tr>
	<td><?=$no?></td>
	<td style="width:200px"><?=$r['nama_petugas']?>
	</td>
	
	<td><a href="javascript:void(0)" class="tul" name="<?=$r['nama_petugas']?>" id="<?=$r['id_petugas']?>" sum="<?=$r['sum_tul']?>" jenis="tul" ><?=$r['sum_tul']?></a></td>
	<td><?=rp($r['sum_tul_rp'])?></td>
	
	<td><a href="javascript:void(0)" class="lunas" name="<?=$r['nama_petugas']?>" id="<?=$r['id_petugas']?>" sum="<?=$r['sum_lunas']?>" jenis="lunas" ><?=$r['sum_lunas']?></a></td>
	<td><?=rp($r['sum_lunas_rp'])?></td>
	
	<td><a href="javascript:void(0)" class="blm" name="<?=$r['nama_petugas']?>" id="<?=$r['id_petugas']?>" sum="<?=$r['sum_blm']?>" jenis="blm" ><?=$r['sum_blm']?></a></td>
	<td><?=rp($r['sum_blm_rp'])?></td>
	
	<th><?=$r['persen_tul']?>%</th>
	<th><?=$r['persen_tul_rp']?>%</th>
	
</tr>

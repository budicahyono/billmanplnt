<tr>	
	<th class="text-center" colspan=2>TOTAL</th> 
<?php 
	if ($opsi == 'sum') {
?>	
	<td><?=$total_A?></td>
	<td><?=$total_B?></td>
	<td><?=$total_C?></td>
	<td><?=$total_D?></td>
	<td><?=$total_E?></td>
	<td><?=$total_F?></td>
	<td><?=$total_G?></td>
	<td><?=$total_H?></td>
	<td><?=$total_I?></td>
	<th><?=$grand_total?></th>

<?php } else { ?>
	<td><?=rp($total_A)?></td>
	<td><?=rp($total_B)?></td>
	<td><?=rp($total_C)?></td>
	<td><?=rp($total_D)?></td>
	<td><?=rp($total_E)?></td>
	<td><?=rp($total_F)?></td>
	<td><?=rp($total_G)?></td>
	<td><?=rp($total_H)?></td>
	<td><?=rp($total_I)?></td>
	<th><?=rp($grand_total)?></th>
	
<?php } ?>	
</tr>
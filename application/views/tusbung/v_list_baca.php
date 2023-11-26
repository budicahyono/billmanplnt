<tr>
	<td><?=$no++?></td>
	<td style="width:200px"><?=$r['nama_petugas']?></td>

<?php 
if ($opsi == 'sum') {
	$sum_A = $r['sum_A']->num_rows();
	$sum_B = $r['sum_B']->num_rows();
	$sum_C = $r['sum_C']->num_rows();
	$sum_D = $r['sum_D']->num_rows();
	$sum_E = $r['sum_E']->num_rows();
	$sum_F = $r['sum_F']->num_rows();
	$sum_G = $r['sum_G']->num_rows();
	$sum_H = $r['sum_H']->num_rows();
	$sum_I = $r['sum_I']->num_rows();
	$total = $sum_A+$sum_B+$sum_C+$sum_D+$sum_E+$sum_F+$sum_G+$sum_H+$sum_I;
	
?>
	<td style="background:<?php if ($sum_A > 0) echo "#e6f2ff"; ?>"><?=$sum_A?></td>
	<td style="background:<?php if ($sum_B > 0) echo "#e6f2ff"; ?>"><?=$sum_B?></td>
	<td style="background:<?php if ($sum_C > 0) echo "#e6f2ff"; ?>"><?=$sum_C?></td>
	<td style="background:<?php if ($sum_D > 0) echo "#e6f2ff"; ?>"><?=$sum_D?></td>
	<td style="background:<?php if ($sum_E > 0) echo "#e6f2ff"; ?>"><?=$sum_E?></td>
	<td style="background:<?php if ($sum_F > 0) echo "#e6f2ff"; ?>"><?=$sum_F?></td>
	<td style="background:<?php if ($sum_G > 0) echo "#e6f2ff"; ?>"><?=$sum_G?></td>
	<td style="background:<?php if ($sum_H > 0) echo "#e6f2ff"; ?>"><?=$sum_H?></td>
	<td style="background:<?php if ($sum_I > 0) echo "#e6f2ff"; ?>"><?=$sum_I?></td>
	<th><?=$total?></th>	

<?php
} else {
	$sum_A = $r['sum_A'];
	$sum_B = $r['sum_B'];
	$sum_C = $r['sum_C'];
	$sum_D = $r['sum_D'];
	$sum_E = $r['sum_E'];
	$sum_F = $r['sum_F'];
	$sum_G = $r['sum_G'];
	$sum_H = $r['sum_H'];
	$sum_I = $r['sum_I'];
	$total = $sum_A+$sum_B+$sum_C+$sum_D+$sum_E+$sum_F+$sum_G+$sum_H+$sum_I;
	

?>
	<td style="background:<?php if ($sum_A > 0) echo "#e6f2ff"; ?>"><?=rp($sum_A)?></td>
	<td style="background:<?php if ($sum_B > 0) echo "#e6f2ff"; ?>"><?=rp($sum_B)?></td>
	<td style="background:<?php if ($sum_C > 0) echo "#e6f2ff"; ?>"><?=rp($sum_C)?></td>
	<td style="background:<?php if ($sum_D > 0) echo "#e6f2ff"; ?>"><?=rp($sum_D)?></td>
	<td style="background:<?php if ($sum_E > 0) echo "#e6f2ff"; ?>"><?=rp($sum_E)?></td>
	<td style="background:<?php if ($sum_F > 0) echo "#e6f2ff"; ?>"><?=rp($sum_F)?></td>
	<td style="background:<?php if ($sum_G > 0) echo "#e6f2ff"; ?>"><?=rp($sum_G)?></td>
	<td style="background:<?php if ($sum_H > 0) echo "#e6f2ff"; ?>"><?=rp($sum_H)?></td>
	<td style="background:<?php if ($sum_I > 0) echo "#e6f2ff"; ?>"><?=rp($sum_I)?></td>
	<th><?=rp($total)?></th>
	
<?php } ?>	
</tr>
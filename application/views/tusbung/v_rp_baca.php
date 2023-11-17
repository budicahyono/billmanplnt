

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
	  <div class="row">
         
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              
			  <div class="card-header">
                <h3 class="card-title"><i class=" fas fa-th-list mr-2"></i>Monitoring Cetak Belum Lunas Berdasarkan Rupiah Baca <?=bln_indo($_SESSION['bulan_sess'])?> <?=$_SESSION['tahun_sess']?></h3>

                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url()?>tusbung/hari_baca" >Hari Baca</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="<?=base_url()?>tusbung/rupiah_baca" >Rupiah Baca</a>
                    </li>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                  </ul>
                  
                  
                  
				  </div> 
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                
                <div class="form-group">
                     <label>Unit</label> 
                <select id="id_unit_rp_baca" class="form-control" name="id_unit">
                <option value="1" selected >MANOKWARI</option>
                 <?php foreach ($unit->result() as $r) { 
                     if ($r->id_unit > 1) { ?>
                    <option value="<?=$r->id_unit?>" <?php if ($id_unit == $r->id_unit) echo "selected" ;?>><?=$r->nama_unit?></option>
                 <?php }} ?>
                 </select> 
               </div> 
               
                 
                 <table id="data_tusbung" class="table table-bordered table-hover " >
                  <thead class="text-center">
                  <tr >
                    <th>NO</th> 
                    <th>NAMA</th>
                    <th>A</th>
                    <th>B</th>
                    <th>C</th>
                    <th>D</th>
                    <th>E</th>
                    <th>F</th>
                    <th>G</th>
                    <th>H</th>
                    <th>I</th>
                    <th>TOTAL</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php  $no=1;
                      $total_A = 0;
                      $total_B = 0;
                      $total_C = 0;
                      $total_D = 0;
                      $total_E = 0;
                      $total_F = 0;
                      $total_G = 0;
                      $total_H = 0;
                      $total_I = 0;
                      $grand_total = 0;
                    foreach ($petugas->result() as $r) {
                    if ($r->is_petugas_khusus == 0) {
                      $sum_A =  $this->M_Tusbung->get_baca_blm_rp($r->id_petugas, "A", $id_unit); 
					  foreach ($sum_A->result() as $row) {
						$rp_A = $row->rptag;
					  } 
                      $sum_B =  $this->M_Tusbung->get_baca_blm_rp($r->id_petugas, "B", $id_unit); 
					  foreach ($sum_B->result() as $row) {
						$rp_B = $row->rptag;
					  } 
                      $sum_C =  $this->M_Tusbung->get_baca_blm_rp($r->id_petugas, "C", $id_unit); 
					  foreach ($sum_C->result() as $row) {
						$rp_C = $row->rptag;
					  } 
                      $sum_D =  $this->M_Tusbung->get_baca_blm_rp($r->id_petugas, "D", $id_unit); 
					  foreach ($sum_D->result() as $row) {
						$rp_D = $row->rptag;
					  }
                      $sum_E =  $this->M_Tusbung->get_baca_blm_rp($r->id_petugas, "E", $id_unit); 
					  foreach ($sum_E->result() as $row) {
						$rp_E = $row->rptag;
					  }
                      $sum_F =  $this->M_Tusbung->get_baca_blm_rp($r->id_petugas, "F", $id_unit); 
                      foreach ($sum_F->result() as $row) {
						  $rp_F = $row->rptag; 
					  } 
					  $sum_G =  $this->M_Tusbung->get_baca_blm_rp($r->id_petugas, "G", $id_unit); 
                      foreach ($sum_G->result() as $row) { 
						  $rp_G = $row->rptag; 
					  }
					  $sum_H =  $this->M_Tusbung->get_baca_blm_rp($r->id_petugas, "H", $id_unit); 
                      foreach ($sum_H->result() as $row) {
						  $rp_H = $row->rptag;
					  }
					  $sum_I =  $this->M_Tusbung->get_baca_blm_rp($r->id_petugas, "I", $id_unit); 
                      foreach ($sum_I->result() as $row) {
						$rp_I = $row->rptag;
					  }
                      $total = $rp_A+$rp_B+$rp_C+$rp_D+$rp_E+$rp_F+$rp_G+$rp_H+$rp_I;
                      $total_A = $total_A + $rp_A;
                      $total_B = $total_B + $rp_B;
                      $total_C = $total_C + $rp_C;
                      $total_D = $total_D + $rp_D;
                      $total_E = $total_E + $rp_E;
                      $total_F = $total_F + $rp_F;
                      $total_G = $total_G + $rp_G;
                      $total_H = $total_H + $rp_H;
                      $total_I = $total_I + $rp_I;
                      $grand_total = $total_A+$total_B+$total_C+$total_D+$total_E+$total_F+$total_G+$total_H+$total_I;
                  ?>	
					<tr>
                    <td><?=$no++?></td>
                    <td style="width:200px"><?=$r->nama_petugas?></td>
                    
                    <td style="background:<?php if ($rp_A > 0) echo "#e6f2ff"; ?>" ><?="Rp ".number_format($rp_A)?></td>
                    <td style="background:<?php if ($rp_B > 0) echo "#e6f2ff"; ?>"><?="Rp ".number_format($rp_B)?></td>
                    <td style="background:<?php if ($rp_C > 0) echo "#e6f2ff"; ?>"><?="Rp ".number_format($rp_C)?></td>
                    <td style="background:<?php if ($rp_D > 0) echo "#e6f2ff"; ?>"><?="Rp ".number_format($rp_D)?></td>
                    <td style="background:<?php if ($rp_E > 0) echo "#e6f2ff"; ?>"><?="Rp ".number_format($rp_E)?></td>
                    <td style="background:<?php if ($rp_F > 0) echo "#e6f2ff"; ?>"><?="Rp ".number_format($rp_F)?></td>
                    <td style="background:<?php if ($rp_G > 0) echo "#e6f2ff"; ?>"><?="Rp ".number_format($rp_G)?></td>
                    <td style="background:<?php if ($rp_H > 0) echo "#e6f2ff"; ?>"><?="Rp ".number_format($rp_H)?></td>
                    <td style="background:<?php if ($rp_I > 0) echo "#e6f2ff"; ?>"><?="Rp ".number_format($rp_I)?></td>
                    <th><?="Rp ".number_format($total)?></th>
                    
                   
                  </tr>
                  
                  <?php  
                    }}
                    foreach ($non_petugas->result() as $r) {
                    if ($r->is_petugas_khusus == 0) {
                      $sum_A =  $this->M_Tusbung->get_baca_blm_rp($r->id_petugas, "A", $id_unit); 
					  foreach ($sum_A->result() as $row) {
						$rp_A = $row->rptag;
					  } 
                      $sum_B =  $this->M_Tusbung->get_baca_blm_rp($r->id_petugas, "B", $id_unit); 
					  foreach ($sum_B->result() as $row) {
						$rp_B = $row->rptag;
					  } 
                      $sum_C =  $this->M_Tusbung->get_baca_blm_rp($r->id_petugas, "C", $id_unit); 
					  foreach ($sum_C->result() as $row) {
						$rp_C = $row->rptag;
					  } 
                      $sum_D =  $this->M_Tusbung->get_baca_blm_rp($r->id_petugas, "D", $id_unit); 
					  foreach ($sum_D->result() as $row) {
						$rp_D = $row->rptag;
					  }
                      $sum_E =  $this->M_Tusbung->get_baca_blm_rp($r->id_petugas, "E", $id_unit); 
					  foreach ($sum_E->result() as $row) {
						$rp_E = $row->rptag;
					  }
                      $sum_F =  $this->M_Tusbung->get_baca_blm_rp($r->id_petugas, "F", $id_unit); 
                      foreach ($sum_F->result() as $row) {
						  $rp_F = $row->rptag; 
					  } 
					  $sum_G =  $this->M_Tusbung->get_baca_blm_rp($r->id_petugas, "G", $id_unit); 
                      foreach ($sum_G->result() as $row) { 
						  $rp_G = $row->rptag; 
					  }
					  $sum_H =  $this->M_Tusbung->get_baca_blm_rp($r->id_petugas, "H", $id_unit); 
                      foreach ($sum_H->result() as $row) {
						  $rp_H = $row->rptag;
					  }
					  $sum_I =  $this->M_Tusbung->get_baca_blm_rp($r->id_petugas, "I", $id_unit); 
                      foreach ($sum_I->result() as $row) {
						$rp_I = $row->rptag;
					  }
                      $total = $rp_A+$rp_B+$rp_C+$rp_D+$rp_E+$rp_F+$rp_G+$rp_H+$rp_I;
                      $total_A = $total_A + $rp_A;
                      $total_B = $total_B + $rp_B;
                      $total_C = $total_C + $rp_C;
                      $total_D = $total_D + $rp_D;
                      $total_E = $total_E + $rp_E;
                      $total_F = $total_F + $rp_F;
                      $total_G = $total_G + $rp_G;
                      $total_H = $total_H + $rp_H;
                      $total_I = $total_I + $rp_I;
                      $grand_total = $total_A+$total_B+$total_C+$total_D+$total_E+$total_F+$total_G+$total_H+$total_I;
                  ?>
					<tr>
                    <td><?=$no++?></td>
                    <td style="width:200px"><?=$r->nama_petugas?></td>
                    
                    <td style="background:<?php if ($rp_A > 0) echo "#e6f2ff"; ?>" ><?="Rp ".number_format($rp_A)?></td>
                    <td style="background:<?php if ($rp_B > 0) echo "#e6f2ff"; ?>"><?="Rp ".number_format($rp_B)?></td>
                    <td style="background:<?php if ($rp_C > 0) echo "#e6f2ff"; ?>"><?="Rp ".number_format($rp_C)?></td>
                    <td style="background:<?php if ($rp_D > 0) echo "#e6f2ff"; ?>"><?="Rp ".number_format($rp_D)?></td>
                    <td style="background:<?php if ($rp_E > 0) echo "#e6f2ff"; ?>"><?="Rp ".number_format($rp_E)?></td>
                    <td style="background:<?php if ($rp_F > 0) echo "#e6f2ff"; ?>"><?="Rp ".number_format($rp_F)?></td>
                    <td style="background:<?php if ($rp_G > 0) echo "#e6f2ff"; ?>"><?="Rp ".number_format($rp_G)?></td>
                    <td style="background:<?php if ($rp_H > 0) echo "#e6f2ff"; ?>"><?="Rp ".number_format($rp_H)?></td>
                    <td style="background:<?php if ($rp_I > 0) echo "#e6f2ff"; ?>"><?="Rp ".number_format($rp_I)?></td>
                     <th><?="Rp ".number_format($total)?></th>
                   
                  </tr>
                  <?php $no++;}} if (count($petugas->result()) == 0) { ?>
                    <tr>
                      <td colspan="6" class="text-center"><b>TIDAK ADA DATA</b></td>
                    </tr>	
                  <?php } ?>	
                  </tbody>
                  <tfoot> 
                  <tr >
                    <th class="text-center" colspan=2>TOTAL</th> 
                    
                    <td style="white-space: nowrap;"><?="Rp ".number_format($total_A)?></td>
                    <td style="white-space: nowrap;"><?="Rp ".number_format($total_B)?></td>
                    <td style="white-space: nowrap;"><?="Rp ".number_format($total_C)?></td>
                    <td style="white-space: nowrap;"><?="Rp ".number_format($total_D)?></td>
                    <td style="white-space: nowrap;"><?="Rp ".number_format($total_E)?></td>
                    <td style="white-space: nowrap;"><?="Rp ".number_format($total_F)?></td>
                    <td style="white-space: nowrap;"><?="Rp ".number_format($total_G)?></td>
                    <td style="white-space: nowrap;"><?="Rp ".number_format($total_H)?></td>
                    <td style="white-space: nowrap;"><?="Rp ".number_format($total_I)?></td>
                    <th style="white-space: nowrap;"><?="Rp ".number_format($grand_total)?></th>
                  </tr>
				  </tfoot> 
                </table>  
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
      </div>
   
      
       
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
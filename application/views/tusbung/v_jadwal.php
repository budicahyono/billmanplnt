

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
	  <div class="row">
         
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              
			  <div class="card-header">
                <h3 class="card-title"><i class=" fas fa-th-list mr-2"></i>Monitoring Cetak Belum Lunas Berdasarkan Hari Baca <?=bln_indo($_SESSION['bulan_sess'])?> <?=$_SESSION['tahun_sess']?></h3>

                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?=base_url()?>tusbung/jadwal" >Hari Baca</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="<?=base_url()?>tusbung/rp_baca" >Rupiah Baca</a>
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
                <select id="id_unit_jadwal" class="form-control" name="id_unit">
                <option value="1" selected >MANOKWARI</option>
                 <?php foreach ($unit->result() as $r) { 
                     if ($r->id_unit > 1) { ?>
                    <option value="<?=$r->id_unit?>" <?php if ($id_unit == $r->id_unit) echo "selected" ;?>><?=$r->nama_unit?></option>
                 <?php }} ?>
                 </select> 
               </div> 
               
                 
                 <table id="data_tusbung" class="table table-bordered table-hover ">
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
                  <tr>
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
                      $sum_A =  $this->M_Tusbung->get_baca_blm($r->id_petugas, "A", $id_unit)->num_rows(); 
                      $sum_B =  $this->M_Tusbung->get_baca_blm($r->id_petugas, "B", $id_unit)->num_rows(); 
                      $sum_C =  $this->M_Tusbung->get_baca_blm($r->id_petugas, "C", $id_unit)->num_rows(); 
                      $sum_D =  $this->M_Tusbung->get_baca_blm($r->id_petugas, "D", $id_unit)->num_rows(); 
                      $sum_E =  $this->M_Tusbung->get_baca_blm($r->id_petugas, "E", $id_unit)->num_rows(); 
                      $sum_F =  $this->M_Tusbung->get_baca_blm($r->id_petugas, "F", $id_unit)->num_rows(); 
                      $sum_G =  $this->M_Tusbung->get_baca_blm($r->id_petugas, "G", $id_unit)->num_rows(); 
                      $sum_H =  $this->M_Tusbung->get_baca_blm($r->id_petugas, "H", $id_unit)->num_rows(); 
                      $sum_I =  $this->M_Tusbung->get_baca_blm($r->id_petugas, "I", $id_unit)->num_rows(); 
                      
                      $total = $sum_A+$sum_B+$sum_C+$sum_D+$sum_E+$sum_F+$sum_G+$sum_H+$sum_I;
                      $total_A = $total_A + $sum_A;
                      $total_B = $total_B + $sum_B;
                      $total_C = $total_C + $sum_C;
                      $total_D = $total_D + $sum_D;
                      $total_E = $total_E + $sum_E;
                      $total_F = $total_F + $sum_F;
                      $total_G = $total_G + $sum_G;
                      $total_H = $total_H + $sum_H;
                      $total_I = $total_I + $sum_I;
                      $grand_total = $total_A+$total_B+$total_C+$total_D+$total_E+$total_F+$total_G+$total_H+$total_I;
                  ?>	
                    <td><?=$no++?></td>
                    <td style="width:200px"><?=$r->nama_petugas?></td>
                    
                    <td style="background:<?php if ($sum_A > 0) echo "#e6f2ff"; ?>" ><?=$sum_A?></td>
                    <td style="background:<?php if ($sum_B > 0) echo "#e6f2ff"; ?>"><?=$sum_B?></td>
                    <td style="background:<?php if ($sum_C > 0) echo "#e6f2ff"; ?>"><?=$sum_C?></td>
                    <td style="background:<?php if ($sum_D > 0) echo "#e6f2ff"; ?>"><?=$sum_D?></td>
                    <td style="background:<?php if ($sum_E > 0) echo "#e6f2ff"; ?>"><?=$sum_E?></td>
                    <td style="background:<?php if ($sum_F > 0) echo "#e6f2ff"; ?>"><?=$sum_F?></td>
                    <td style="background:<?php if ($sum_G > 0) echo "#e6f2ff"; ?>"><?=$sum_G?></td>
                    <td style="background:<?php if ($sum_H > 0) echo "#e6f2ff"; ?>"><?=$sum_H?></td>
                    <td style="background:<?php if ($sum_I > 0) echo "#e6f2ff"; ?>"><?=$sum_I?></td>
                    <th><?=$total?></th>
                    
                    
                  </tr>
                  <tr>
                  <?php  
                    }}
                    foreach ($non_petugas->result() as $r) {
                    if ($r->is_petugas_khusus == 0) {
                      $sum_A =  $this->M_Tusbung->get_baca_blm($r->id_petugas, "A", $id_unit)->num_rows(); 
                      $sum_B =  $this->M_Tusbung->get_baca_blm($r->id_petugas, "B", $id_unit)->num_rows(); 
                      $sum_C =  $this->M_Tusbung->get_baca_blm($r->id_petugas, "C", $id_unit)->num_rows(); 
                      $sum_D =  $this->M_Tusbung->get_baca_blm($r->id_petugas, "D", $id_unit)->num_rows(); 
                      $sum_E =  $this->M_Tusbung->get_baca_blm($r->id_petugas, "E", $id_unit)->num_rows(); 
                      $sum_F =  $this->M_Tusbung->get_baca_blm($r->id_petugas, "F", $id_unit)->num_rows(); 
                      $sum_G =  $this->M_Tusbung->get_baca_blm($r->id_petugas, "G", $id_unit)->num_rows(); 
                      $sum_H =  $this->M_Tusbung->get_baca_blm($r->id_petugas, "H", $id_unit)->num_rows(); 
                      $sum_I =  $this->M_Tusbung->get_baca_blm($r->id_petugas, "I", $id_unit)->num_rows(); 
                      
                      $total = $sum_A+$sum_B+$sum_C+$sum_D+$sum_E+$sum_F+$sum_G+$sum_H+$sum_I;
                      $total_A = $total_A + $sum_A;
                      $total_B = $total_B + $sum_B;
                      $total_C = $total_C + $sum_C;
                      $total_D = $total_D + $sum_D;
                      $total_E = $total_E + $sum_E;
                      $total_F = $total_F + $sum_F;
                      $total_G = $total_G + $sum_G;
                      $total_H = $total_H + $sum_H;
                      $total_I = $total_I + $sum_I;
                      $grand_total = $total_A+$total_B+$total_C+$total_D+$total_E+$total_F+$total_G+$total_H+$total_I;
                  ?>	
                    <td><?=$no++?></td>
                    <td style="width:200px"><?=$r->nama_petugas?></td>
                    
                    <td style="background:<?php if ($sum_A > 0) echo "#e6f2ff"; ?>" ><?=$sum_A?></td>
                    <td style="background:<?php if ($sum_B > 0) echo "#e6f2ff"; ?>"><?=$sum_B?></td>
                    <td style="background:<?php if ($sum_C > 0) echo "#e6f2ff"; ?>"><?=$sum_C?></td>
                    <td style="background:<?php if ($sum_D > 0) echo "#e6f2ff"; ?>"><?=$sum_D?></td>
                    <td style="background:<?php if ($sum_E > 0) echo "#e6f2ff"; ?>"><?=$sum_E?></td>
                    <td style="background:<?php if ($sum_F > 0) echo "#e6f2ff"; ?>"><?=$sum_F?></td>
                    <td style="background:<?php if ($sum_G > 0) echo "#e6f2ff"; ?>"><?=$sum_G?></td>
                    <td style="background:<?php if ($sum_H > 0) echo "#e6f2ff"; ?>"><?=$sum_H?></td>
                    <td style="background:<?php if ($sum_I > 0) echo "#e6f2ff"; ?>"><?=$sum_I?></td>    
                    <th><?=$total?></th>
                    
                  </tr>
                  <?php $no++;}} if (count($petugas->result()) == 0) { ?>
                    <tr>
                      <td colspan="6" class="text-center"><b>TIDAK ADA DATA</b></td>
                    </tr>	
                  <?php } ?>	
                  </tbody>
                  <tfoot>  
                  <tr >
                  <?php 
                  
               
                  ?>
                    <th class="text-center" colspan=2>TOTAL</th> 
                    
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


<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
	  <div class="row">
         
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              
			  <div class="card-header">
                <h3 class="card-title"><i class=" fas fa-th-list mr-2"></i>Monitoring Data Tusbung <?=bln_indo($_SESSION['bulan_sess'])?> <?=$_SESSION['tahun_sess']?></h3>

                <div class="card-tools">
                  
                    
                  <a onclick="return confirm('Apa anda yakin ingin menghapus tusbung <?=$nama_unit?> pada bulan <?=bln_indo($_SESSION['bulan_sess'])?> dan tahun <?=$_SESSION['tahun_sess']?>? ')" class="btn btn-danger btn-md" href="<?=base_url()?>tusbung/hapus/<?=$id_unit?>" ><i class="fa fa-trash"></i> Hapus Tusbung</a>
                    
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                 
				  </div> 
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                
                <div class="form-group">
                     <label>Unit</label> 
                <select id="id_unit" class="form-control" name="id_unit">
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
                    <th rowspan=2 style="vertical-align:middle">NO</th> 
                    <th rowspan=2 style="vertical-align:middle">NAMA</th>
                    <th colspan=2>TUL TUSBUNG</th>
                    <th colspan=2>LUNAS</th>
                    <th colspan=2>BELUM LUNAS</th>
                    <th rowspan=2 style="vertical-align:middle">REALISASI PLG</th>
                    <th rowspan=2 style="vertical-align:middle">REALISASI RUPIAH</th>
                  </tr>
                  <tr >
                    <th >PLG</th> 
                    <th >RUPIAH</th>
                    
                    <th >PLG</th> 
                    <th >RUPIAH</th>
                    
                    <th >PLG</th> 
                    <th >RUPIAH</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                  <?php  $no=1;
                    foreach ($petugas->result() as $r) {
                    if ($r->is_petugas_khusus == 0) {
                    
                    //ambil semua tul per petugas, kebetulan LBR / tagihannya hanya 1 bulan
                    $sum_tul =  $this->M_Tusbung->get_tul_petugas($r->id_petugas, $id_unit)->num_rows(); 
                    
                    //ambil semua tul dan hitung rupiahnya per petugas 
                    $cek_tul_rp =  $this->M_Tusbung->get_tul_petugas_rp($r->id_petugas, $id_unit);
                    foreach ($cek_tul_rp->result() as $row) {
                        $sum_tul_rp = $row->rptag;
                     }
                     
                      //ambil semua tul per petugas yg lunas
                    $sum_lunas =  $this->M_Tusbung->get_tul_lunas($r->id_petugas, $id_unit)->num_rows(); 
                    
                     //ambil semua tul per petugas yg lunas dan hitung rupiahnya
                    $cek_lunas_rp =  $this->M_Tusbung->get_tul_lunas_rp($r->id_petugas, $id_unit); 
                    foreach ($cek_lunas_rp->result() as $row) {
                        $sum_lunas_rp = $row->rptag;
                     }
                     
                       //ambil semua tul per petugas yg blm lunas
                    $sum_blm =  $this->M_Tusbung->get_tul_blm($r->id_petugas, $id_unit)->num_rows(); 
                    
                     //ambil semua tul per petugas yg blm lunas dan hitung rupiahnya
                    $cek_blm_rp =  $this->M_Tusbung->get_tul_blm_rp($r->id_petugas, $id_unit); 
                    foreach ($cek_blm_rp->result() as $row) {
                        $sum_blm_rp = $row->rptag;
                     }
                     
                     //realisasi pelanggan / tul yg lunas
                    if ($sum_tul != 0 && $sum_lunas != 0) {
                        $persen_tul = round($sum_lunas / $sum_tul * 100);
                    } else {
                        $persen_tul = 0;
                    }
                    
                    //realisasi rupiah yg lunas
                    if ($sum_tul_rp != 0 && $sum_lunas_rp != 0) {
                        $persen_tul_rp = round($sum_lunas_rp / $sum_tul_rp * 100);
                    } else {
                        $persen_tul_rp = 0;
                    }
                    
                  ?>	
                    <td><?=$no++?></td>
                    <td style="width:200px"><?=$r->nama_petugas?></td>
                    
                    <td><?=$sum_tul?></td>
                    <td><?="Rp ".number_format($sum_tul_rp)?></td>
                    
                    <td><?=$sum_lunas?></td>
                    <td><?="Rp ".number_format($sum_lunas_rp)?></td>
                    
                    <td><?=$sum_blm?></td>
                    <td><?="Rp ".number_format($sum_blm_rp)?></td>
                    
                    <th><?=$persen_tul?>%</td>
                    <th><?=$persen_tul_rp?>%</td>
                   
                  </tr>
                  <tr>
                  <?php  
                    }}
                    foreach ($non_petugas->result() as $r) {
                    if ($r->is_petugas_khusus == 0) {
                    
                     //ambil semua tul per petugas, kebetulan LBR / tagihannya hanya 1 bulan
                    $sum_tul2 =  $this->M_Tusbung->get_tul_petugas($r->id_petugas, $id_unit)->num_rows(); 
                    
                    //ambil semua tul dan hitung rupiahnya per petugas 
                    $cek_tul_rp2 =  $this->M_Tusbung->get_tul_petugas_rp($r->id_petugas, $id_unit);
                    foreach ($cek_tul_rp2->result() as $row) {
                        $sum_tul_rp2 = $row->rptag;
                     }
                     
                      //ambil semua tul per petugas yg lunas
                    $sum_lunas2 =  $this->M_Tusbung->get_tul_lunas($r->id_petugas, $id_unit)->num_rows(); 
                    
                     //ambil semua tul per petugas yg lunas dan hitung rupiahnya
                    $cek_lunas_rp2 =  $this->M_Tusbung->get_tul_lunas_rp($r->id_petugas, $id_unit); 
                    foreach ($cek_lunas_rp2->result() as $row) {
                        $sum_lunas_rp2 = $row->rptag;
                     }
                     
                       //ambil semua tul per petugas yg blm lunas
                    $sum_blm2 =  $this->M_Tusbung->get_tul_blm($r->id_petugas, $id_unit)->num_rows(); 
                    
                     //ambil semua tul per petugas yg blm lunas dan hitung rupiahnya
                    $cek_blm_rp2 =  $this->M_Tusbung->get_tul_blm_rp($r->id_petugas, $id_unit); 
                    foreach ($cek_blm_rp2->result() as $row) {
                        $sum_blm_rp2 = $row->rptag;
                     }
                     
                      //realisasi pelanggan / tul yg lunas
                    if ($sum_tul2 != 0 && $sum_lunas2 != 0) {
                        $persen_tul2 = round($sum_lunas2 / $sum_tul2 * 100);
                    } else {
                        $persen_tul2 = 0;
                    }
                    
                    //realisasi rupiah yg lunas
                    if ($sum_tul_rp2 != 0 && $sum_lunas_rp2 != 0) {
                        $persen_tul_rp2 = round($sum_lunas_rp2 / $sum_tul_rp2 * 100);
                    } else {
                        $persen_tul_rp2 = 0;
                    }
                  ?>	
                    <td><?=$no?></td>
                    <td style="width:200px"><?=$r->nama_petugas?></td>
                    
                    <td><?=$sum_tul2?></td>
                    <td><?="Rp ".number_format($sum_tul_rp2)?></td>
                    
                    <td><?=$sum_lunas2?></td>
                    <td><?="Rp ".number_format($sum_lunas_rp2)?></td>
                    
                    <td><?=$sum_blm2?></td>
                    <td><?="Rp ".number_format($sum_blm_rp2)?></td>
                    
                     <th><?=$persen_tul2?>%</td>
                    <th><?=$persen_tul_rp2?>%</td>
                    
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
                  
                $total_tul = $this->M_Tusbung->get_by_unit($id_unit)->num_rows(); //tul total
                $lunas_tul = $this->M_Tusbung->get_lunas($id_unit)->num_rows(); //tul lunas
                $blm_tul = $this->M_Tusbung->get_blm($id_unit)->num_rows(); //tul blm
	 
                if ($total_tul != 0 && $lunas_tul != 0) {
                    $persen_tul_total = round($lunas_tul / $total_tul * 100, 1);
                } else {
                    $persen_tul_total = 0;
                }    
                
                $cek_total_rp = $this->M_Tusbung->get_unit_rp($id_unit); //tul total rupiah
                foreach ($cek_total_rp->result() as $row) {
                  $total_rp = $row->rptag;
                }
                
                $cek_total_lunas_rp = $this->M_Tusbung->get_lunas_rp($id_unit); //tul total rupiah lunas
                foreach ($cek_total_lunas_rp->result() as $row) {
                  $total_lunas_rp = $row->rptag;
                }
                
                $cek_total_blm_rp = $this->M_Tusbung->get_blm_rp($id_unit); //tul total rupiah blm
                foreach ($cek_total_blm_rp->result() as $row) {
                  $total_blm_rp = $row->rptag;
                }
                
                if ($total_rp != 0 && $total_lunas_rp != 0) {
                    $persen_total_rp = round($total_lunas_rp / $total_rp * 100, 1);
                } else {
                    $persen_total_rp = 0;
                } 
                  ?>
                    <th class="text-center" colspan=2 style="vertical-align:middle">TOTAL</th> 
                    
                    <th ><?=$total_tul?></th>
                    <th><?="Rp ".number_format($total_rp)?></th>
                    
                    <th ><?=$lunas_tul?></th>
                    <th><?="Rp ".number_format($total_lunas_rp)?></th>
                    
                    <th ><?=$blm_tul?></th>
                    <th><?="Rp ".number_format($total_blm_rp)?></th>
                    
                    <th><?=$persen_tul_total?>%</th>
                    <th><?=$persen_total_rp?>%</th>
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
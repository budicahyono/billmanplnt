

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
	  <div class="row">
         
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              
			  <div class="card-header">
                <h3 class="card-title"><i class=" fas fa-th-list mr-2"></i>Monitoring Data Tusbung <?=bln_indo($_SESSION['bulan_sess'])?> <?=$_SESSION['tahun_sess']?></h3>

                <div class="card-tools">
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
               
                 
                 <table id="data_tusbung" class="table table-bordered table-hover">
                  <thead class="text-center">
                  <tr >
                    <th rowspan=2 style="vertical-align:middle">NO</th> 
                    <th rowspan=2 style="vertical-align:middle">NAMA</th>
                    <th colspan=2>TUL TUSBUNG</th>
                    <th colspan=2>LUNAS</th>
                    <th colspan=2>BELUM LUNAS</th>
                    <th rowspan=2 style="vertical-align:middle">REALISASI PLG</th>
                    <th rowspan=2 style="vertical-align:middle">REALISASI RUPIAH</th>
                    <th rowspan=2 style="vertical-align:middle">Action</th>
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
                  ?>	
                    <td><?=$no++?></td>
                    <td style="width:200px"><?=$r->nama_petugas?></td>
                    
                    <td><?=$sum_tul?></td>
                    <td><?="Rp ".number_format($sum_tul_rp)?></td>
                    
                    <td><?=$sum_lunas?></td>
                    <td></td>
                    
                    <td></td>
                    <td></td>
                    
                    <td></td>
                    <td></td>
                    <td style="width:100px">
                      <a  href="tusbung/detail/<?php echo $r->id_petugas ?>" class="btn btn-info "><i class="fa fa-edit"></i> Detail</a>
                       
                        
                    </td>
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
                  ?>	
                    <td><?=$no?></td>
                    <td style="width:200px"><?=$r->nama_petugas?></td>
                    
                    <td><?=$sum_tul2?></td>
                    <td><?="Rp ".number_format($sum_tul_rp2)?></td>
                    
                    <td><?=$sum_lunas2?></td>
                    <td></td>
                    
                    <td></td>
                    <td></td>
                    
                    <td></td>
                    <td></td>
                    <td style="width:100px">
                      <a  href="tusbung/detail/<?php echo $r->id_petugas ?>" class="btn btn-info "><i class="fa fa-edit"></i> Detail</a>
                       
                        
                    </td>
                  </tr>
                  <?php $no++;}} if (count($petugas->result()) == 0) { ?>
                    <tr>
                      <td colspan="6" class="text-center"><b>TIDAK ADA DATA</b></td>
                    </tr>	
                  <?php } ?>	
                  </tbody>
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
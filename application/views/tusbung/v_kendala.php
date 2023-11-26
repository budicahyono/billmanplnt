

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
	  <div class="row">
         
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              
			  <div class="card-header">
                <h3 class="card-title"><i class=" fas fa-th-list mr-2"></i> Monitoring Kendala Pelanggan Belum Lunas</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
              
                 <div class="form-group">
                      <label>Unit</label> 
                      <select id="id_unit_kendala" class="form-control" name="id_unit">
                        <option value="1" selected >MANOKWARI</option>
                         <?php foreach ($unit->result() as $r) { 
                             if ($r->id_unit > 1) { ?>
                            <option value="<?=$r->id_unit?>" <?php if ($id_unit == $r->id_unit) echo "selected" ;?>><?=$r->nama_unit?></option>
                         <?php }} ?>
                       </select> 
                       
                       
                  </div> 
              
                <table id="data_search" class="table table-bordered table-hover ">
                  <thead class="text-center">
                  <tr >
                    <th>NO</th> 
                    <th>JENIS KENDALA</th>
                    <th>PELANGGAN</th>
                    <th>RUPIAH</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php  $no=1;
                    $total_sum  = 0;
                    $total_rp   = 0;
                    foreach ($jenis_kendala as $r) {
                      if ($r['id_jenis_kendala'] != 28 && $r['id_jenis_kendala'] != 0) {
                      
                      $sum_tul      = $r['sum_tul'];
                      $total_sum    = $total_sum + $sum_tul;
                      
                      $sum_rp       = $r['sum_rp'];
                      $total_rp     = $total_rp + $sum_rp;
						?>	
                    <tr>    
                    <td style="width:10px"><?=$no?></td>
                    <td style="width:200px"><?=$r['nama_jenis_kendala']?></td>
                    <td><?=$sum_tul?></td>
                    <td><?=rp($sum_rp)?></td>
                  </tr>
                  <?php 
                    $no++;
                    }} if (count($jenis_kendala) == 0) { ?>
                  <tr>
                  <td colspan="4" class="text-center"><b>TIDAK ADA DATA</b></td>
                  </tr>	
                  <?php } ?>	
                  
                  </tbody>
                  <tfoot> 
                  <tr >
                  
                    <th class="text-center" colspan=2 style="vertical-align:middle">TOTAL</th> 
                    
                    <th><?=$total_sum?></th>
                    <th><?=rp($total_rp)?></th>
                    
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
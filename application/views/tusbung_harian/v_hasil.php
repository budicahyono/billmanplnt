

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
	  <div class="row">
         
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              
			  <div class="card-header">
                <h3 class="card-title"><i class=" fas fa-th-list mr-2"></i>Hasil Import Tusbung Harian <?=$nama_unit?></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
				  </div> 
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
				<div class="row">
					<div class="col-lg-6">
							
						 <table class="table table-bordered">
							  <tr>
								<td>Data tusbung harian yang berhasil diinput : </td>
								<th><?=$sum_tusbung_harian?></th>
							  </tr>	
							  <tr>	
								<td>Data tusbung harian yang duplikat : </td>
								<th><?=$sum_duplikat?></th>
							  </tr>
						 </table>
					</div>
					
					
					<div class="col-lg-12">	 
						 <?php 
						 if ($sum_duplikat > 0 ) { // jika ada duplikat 
					
						if ($sum_duplikat <= 100 ) { // tampilkan duplikat hanya 100 ?>
								<h5>Data tusbung harian yang duplikat </h5>
						<table class="table table-bordered">	
							<tr>
								<th>NO</th>
								<th>ID Pelanggan</th>
								<th>Nama Pelanggan</th>
								<th>Tarif</th>
								<th>Daya</th>
								<th>Gol</th>
								<th>Alamat</th>
								<th>KDDK</th>
								<th>Status</th>
								<th>Evidence</th>
								<th>Tgl. Tusbung</th>
								<th>ID Jenis Kendala</th>
							</tr>
							
								<?php
								$no = 1;
								foreach ($duplikat_pelanggan as $r) { ?>
								<tr>
								<td><?=$no++?></td>
								<td><?=$r['id_pelanggan']?></td>
								<td><?=$r['nama_pelanggan']?></td>
								<td><?=$r['tarif']?></td>
								<td><?=$r['daya']?></td>
								<td><?=$r['gol']?></td>
								<td><?=$r['alamat']?></td>
								<td><?=$r['kddk']?></td>
								<td><?=$r['no_hp']?></td>
								<td><?=$r['is_evidence']?></td>
								<td><?=$r['tgl_tusbung']?></td>
								<td><?=$r['id_jenis_kendala']?></td>
								</tr>	
								<?php } ?>
							
						</table>	
					</div>	
					
					
						<?php	
							} 
						} else { // jika tidak ada duplikat ?>
						<div class="col-lg-6">
						<table class="table table-bordered">
							  <tr>
								<td>Total Data Tusbung Harian : </td>
								<th><?=$sum_tusbung_harian?></th>
							  </tr>
						 </table>
						 </div>
					<?php  } ?>
					
					
					
						<div class="form-group ">
							<a href="<?=base_url('tusbung_harian/back')?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali</a>
							<a href="<?=base_url('tusbung_harian/next?id_unit='.$id_unit)?>" class="btn btn-success"><i class="fa fa-arrow-right"></i> Monitoring</a>
						</div> 
						 
					 
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
      </div>
   
      
       
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
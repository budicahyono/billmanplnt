

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
	  <div class="row">
         
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              
			  <div class="card-header">
                <h3 class="card-title"><i class=" fas fa-th-list mr-2"></i>Hasil Import Tusbung</h3>

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
								<td>Data pelanggan yang berhasil diinput : </td>
								<th><?=$sum_pelanggan?></th>
							  </tr>
							  <tr>
								<td>Data tusbung yang berhasil diinput : </td>
								<th><?=$sum_tusbung?></th>
							  </tr>	
							  <tr>	
								<td>Data pelanggan yang duplikat : </td>
								<th><?=$sum_duplikat?></th>
							  </tr>
							  <tr>	
								<td>Data tusbung yang duplikat : </td>
								<th><?=$sum_tus_duplikat?></th>
							  </tr>
						 </table>
					</div>
					
					
					<div class="col-lg-12">	 
						 <?php 
						 if ($sum_duplikat > 0 &&  $sum_tus_duplikat > 0) { // jika ada duplikat 
					
							if ($sum_duplikat <= 100 && $sum_tus_duplikat <= 100) { // tampilkan duplikat hanya 100 ?>
								<h5>Data pelanggan dan tusbung yang duplikat </h5>
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
								<th>No.HP</th>
								<th>ID Petugas</th>
								<th>LBR</th>
								<th>Rptag</th>
								<th>ID Jenis Kendala</th>
								<th>ID Rp Kategori</th>
								<th>Bulan</th>
								<th>Tahun</th>
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
								<td><?=$r['id_petugas']?></td>
								<?php	
									foreach ($duplikat_tusbung as $t) {
										if ($t['id_pelanggan'] == $r['id_pelanggan']) { ?>
										<td><?=$t['lbr']?></td>
										<td><?=$t['rptag']?></td>
										<td><?=$t['id_jenis_kendala']?></td>
										<td><?=$t['id_rp_kategori']?></td>
										<td><?=$t['bulan']?></td>
										<td><?=$t['tahun']?></td>
									<?php					
										}
									} ?>
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
								<td>Total pelanggan baru : </td>
								<th><?=$sum_pelanggan?></th>
							  </tr>
							  <tr>
								<td>Total pelanggan lama : </td>
								<th><?=$sum_duplikat?></th>
							  </tr>	
							  <tr>	
								<td>Total data pelanggan sekarang (sesuai dengan jumlah tusbung) : </td>
								<th><?=$total?></th>
							  </tr>
							 
						 </table>
						 </div>
					<?php  } ?>
					
					
					
						<div class="form-group ">
							<a href="<?=base_url('tusbung/back')?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali</a>
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


<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
	  <div class="row">
         
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              
			  <div class="card-header">
                <h3 class="card-title"><i class=" fas fa-th-list mr-2"></i> Data Jenis Kendala</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">

                <div class="form-group">
                  <a href="<?=base_url('jenis_kendala/tambah')?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah jenis kendala</a>
                </div>
                <table id="data_search" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Jenis Kendala</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php  $no=1;
                    foreach ($jenis_kendala->result() as $r) {
						?>	
                    <tr>    
                    <td><?=$no?></td>
                    <td><?=$r->nama_jenis_kendala?></td>
                    <td style="width:200px">
                      <a  href="jenis_kendala/edit/<?php echo $r->id_jenis_kendala ?>" class="btn btn-info "><i class="fa fa-edit"></i> Edit</a>
                      <a  onclick="return confirm('Apa anda yakin ingin menghapusnya?')" href="jenis_kendala/hapus/<?php echo $r->id_jenis_kendala ?>" class="btn btn-danger "><i class="fa fa-trash"></i> Hapus</a>  
                        
                    </td>
                  </tr>
                  <?php 
$no++;
} if (count($jenis_kendala->result()) == 0) { ?>
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
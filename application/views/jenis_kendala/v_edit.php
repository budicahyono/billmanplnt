

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
	  <div class="row">
         
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              
			  <div class="card-header">
                <h3 class="card-title"><i class=" fas fa-th-list mr-2"></i> Edit Jenis Kendala</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">

               <div class="form-group ">
                <a href="<?=base_url('jenis_kendala')?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>	
				<?php foreach ($jenis_kendala->result() as $r) { ?>
                <form  action="<?=base_url('jenis_kendala/proses_edit')?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                <label>Nama Jenis Kendala</label>
                <input value="<?=$r->id_jenis_kendala?>" required name="id_jenis_kendala" type="hidden" class="form-control" >
                <input value="<?=$r->nama_jenis_kendala?>" required name="nama_jenis_kendala" type="text" class="form-control" >
                </div>
                
                <button name="submit" type="submit" class="btn btn-primary "><i class="fa fa-check"></i> Simpan</button>
                <button type="reset" class="btn btn-warning "><i class="fa fa-times"></i> Reset</button>
                </form>
                <?php } ?>
                
              </div>
            </div>
            
            
            
          </div>
          <!-- /.col-md-6 -->
      </div>
   
      
       
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
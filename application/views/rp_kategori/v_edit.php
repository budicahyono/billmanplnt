

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
	  <div class="row">
         
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              
			  <div class="card-header">
                <h3 class="card-title"><i class=" fas fa-th-list mr-2"></i> Edit Rp Kategori</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">

               <div class="form-group ">
                <a href="<?=base_url('rp_kategori')?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>	
				<?php foreach ($rp_kategori->result() as $r) { ?>
                <form  action="<?=base_url('rp_kategori/proses_edit')?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                <label>Nama Rp Kategori</label>
                <input value="<?=$r->id_rp_kategori?>" required name="id_rp_kategori" type="hidden" class="form-control" >
                <input value="<?=$r->nama_rp_kategori?>" required name="nama_rp_kategori" type="text" class="form-control" >
                </div>
                 <div class="form-group">
                <label>Rupiah Batas Bawah</label>
                <input value="<?=$r->rp_bawah?>" required name="rp_bawah" type="number" class="form-control" >
                 <small>Misalnya 200rb-500rb maka batas bawah 200.001</small>
                </div>
                <div class="form-group">
                <label>Rupiah Batas Atas</label>
                <input value="<?=$r->rp_atas?>" required name="rp_atas" type="number" class="form-control" >
                <small>Misalnya 200rb-500rb maka batas atas 500.000</small>
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
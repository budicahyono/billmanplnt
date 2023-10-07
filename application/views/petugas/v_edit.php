

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
	  <div class="row">
         
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              
			  <div class="card-header">
                <h3 class="card-title"><i class=" fas fa-th-list mr-2"></i> Edit Petugas</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">

               <div class="form-group ">
                <a href="<?=base_url('petugas')?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>	
				<?php foreach ($petugas->result() as $r) { ?>
                <form  action="<?=base_url('petugas/proses_edit')?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                <label>Nama Petugas</label>
                 <input value="<?=$r->id_petugas?>" required name="id_petugas" type="hidden" class="form-control" >
                <input value="<?=$r->nama_petugas?>" required name="nama_petugas" type="text" class="form-control" >
                </div>
                
                <div class="form-group">
                <label>Username</label>
                <input value="<?=$r->username?>" required name="username" type="text" class="form-control" >
                </div>
                <div class="form-group">
                <label>Password</label>
                <input  name="password" type="password" class="form-control" maxlength="10">
                <input  name="password_old" type="hidden" class="form-control" value="<?=$r->password?>">
                <small>Jika ingin ubah password silakan diinput, jika tidak diubah bisa kosongkan ini</small>
                </div>
                <div class="form-group">
                <label>Ketik Ulang Password</label>
                <input  name="password_again" type="password" class="form-control" maxlength="10">
                <small>Jika ingin ubah password silakan diinput, jika tidak diubah bisa kosongkan ini</small>
                </div>
                <div class="form-group">
                <label>Petugas Khusus?</label>
                  <div class="custom-control custom-checkbox">
                    <input name="is_petugas_khusus" class="custom-control-input" type="checkbox" id="is_petugas_khusus" value="1" <?php if ($r->is_petugas_khusus == 1) echo "checked"; ?>>
                    <label for="is_petugas_khusus" class="custom-control-label">Ya Petugas Khusus</label>
                  </div>
                </div>
                
                <div class="form-group">
                <label>Unit</label>
                <select class="form-control" name="id_unit">
                 <?php foreach ($unit->result() as $r_unit) {  ?>
                    <option value="<?=$r_unit->id_unit?>" <?php if ($r->id_unit == $r_unit->id_unit) echo "selected"; ?>><?=$r_unit->nama_unit?></option>
                 <?php } ?>
                 </select>
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
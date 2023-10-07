

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
	  <div class="row">
         
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              
			  <div class="card-header">
                <h3 class="card-title"><i class=" fas fa-th-list mr-2"></i> Edit Admin</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">

               <div class="form-group ">
                <a href="<?=base_url('admin')?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>	
				<?php foreach ($admin->result() as $r) { ?>
                <form  action="<?=base_url('admin/proses_edit')?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                <label>Nama Admin</label>
                <input value="<?=$r->id_admin?>" required name="id_admin" type="hidden" class="form-control" >
                <input value="<?=$r->nama_admin?>" required name="nama_admin" type="text" class="form-control" >
                </div>
                <div class="form-group">
                <label>Username</label>
                <input  required value="<?=$r->username?>" name="username" type="text" class="form-control" >
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
				<small>Jika ingin ubah password silakan diinput, jika tidak diubah bisa  kosongkan ini</small>
                </div>
                <div class="form-group">
                <label>Level</label>
                <select class="form-control" name="level">
                <option value="admin" <?php if ($r->level == "admin") echo "selected"; ?>>Admin</option>
                <option value="manager" <?php if ($r->level == "manager") echo "selected"; ?>>Manager</option>
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
<div class="login-box">
  <div class="login-logo">
  <img src="<?=base_url(myapp('logo'));?>" width="100%">
    <a href="<?=base_url();?>"><b><?=myapp('front_name')?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Login Admin & Manager</p>
	  
	<?php if ($this->session->flashdata('status') != null) { ?>			
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h5><i class="icon fas fa-ban"></i> Alert!</h5>
            <?= $this->session->flashdata('status') ?>     
    </div>	
	<?php } ?>
      <form action="<?=base_url();?>login/check" method="POST">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-key"></span>
            </div>
          </div>
        </div>
       
		
		<div class="input-group mb-3">
		  <input name="password" id="password" type="password" class="form-control" placeholder="Password">
		  <span class="input-group-append">
			<button type="button" id="open_pass" class="btn btn-info btn-flat"><i id="eye" class="fas fa-eye-slash"></i></button>
		  </span>
		</div>
				
		<div class="form-group row">
                  <div class="col-lg-6">
                    <label>Bulan</label>
                    <br/>
                    <select name="bulan" id="bulan" class="form-control" required>
                    <option value="">--Pilih Bulan--</option>
                      <?php
                      $bln_skrg = date("m");
                     $jumlah_bulan = 12;
                      for ($i=1;$i<=$jumlah_bulan;$i++){
                        if ($bln_skrg == $i) {
                          echo '<option value="'.$i.'" selected>'.bln_indo($i).'</option>';
                        } else {
                          echo '<option value="'.$i.'">'.bln_indo($i).'</option>';
                        }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-lg-6">
                    <label>Tahun</label>
                    <br/>
                    <select name="tahun" id="tahun" class="form-control" required>
                    <option value="">--Pilih tahun--</option>
                      <?php
                      $thn_awal = 2022;
                      $thn_skrg = date("Y");
                      $jumlah_thn = 3;
                      $selisih = $thn_skrg - $thn_awal;
                      $tambah = $selisih + $thn_awal + $jumlah_thn;
                      for ($i=$thn_awal;$i<=$tambah;$i++){
                        if ($thn_skrg == $i) {
                           echo '<option value="'.$i.'" selected>'.$i.'</option>';
                        } else {
                           echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                      }
                      ?>
                    </select>
                  </div>
				  </div>
                		
		<button type="submit" name="submit" value="submit" class="btn btn-block btn-primary">
			<i class="fas fa-sign-in-alt mr-2"></i> Login
        </button>
       
      </form>

     

      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
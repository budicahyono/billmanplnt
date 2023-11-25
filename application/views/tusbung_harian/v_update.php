

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
	  <div class="row">
         
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              
			  <div class="card-header">
                <h3 class="card-title"><i class=" fas fa-th-list mr-2"></i> Update Lunas Harian</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">

                <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i> Perhatian!</h5>
                  Ini adalah halaman import untuk update lunas tusbung yang dilakukan oleh pelanggan sendiri. Pastikan kolom yang diinput sesuai sbb:<br> 
                  PETUGAS :<b>NON PETUGAS</b><br>
                  STATUS BARU :<b>LUNAS</b><br>
                  LUNAS : <b>lunas</b><br>
                  Harap mengikuti format excel berikut agar data Tusbung dapat berhasil di import. Silahkan download <a class="text-href" href="<?=base_url('import/Format Import Tusbung Lunas.xlsx')?>">disini</a>
                </div>
               
                <form  action="<?=base_url('tusbung_harian/hasil_update')?>" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                  <div class="col-lg-4">
                  <label>Tanggal</label>
                    <br/>
                    <select name="tanggal" id="tanggal" class="form-control"  >
                      <option value="">--Pilih Tanggal--</option>
                      <?php
                       $tgl_skrg = date("d");
                      $bln_skrg = $_SESSION['bulan_sess'];
					  $thn_skrg = $_SESSION['tahun_sess'];
                     $jumlah_tanggal = cal_days_in_month(CAL_GREGORIAN, $bln_skrg, $thn_skrg);
                      for ($i=1;$i<=$jumlah_tanggal;$i++){
                        if ($tgl_skrg == $i) {
                          echo '<option value="'.$i.'" selected>'.$i.'</option>';
                        } else {
                          echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-lg-4">
                    <label>Bulan</label>
                    <br/>
                    <select name="bulan" id="bulan" class="form-control" disabled >
                      <option value="<?=$_SESSION['bulan_sess']?>" selected><?=bln_indo($_SESSION['bulan_sess'])?></option>
                    </select>
                  </div>
                  <div class="col-lg-4">
                    <label>Tahun</label>
                    <br/>
                    <select name="tahun" id="tahun" class="form-control" disabled>
                      <option value="<?=$_SESSION['tahun_sess']?>" selected><?=$_SESSION['tahun_sess']?></option>
                    </select>
                  </div>
                </div>
                
                <div class="form-group">
                     <label>Unit</label> 
                <select class="form-control" name="id_unit">
                 <?php foreach ($unit->result() as $r) { 
                     if (!$r->id_unit == 0) { ?>
                    <option value="<?=$r->id_unit?>"><?=$r->nama_unit?></option>
                 <?php }} ?>
                 </select> 
               </div> 
                <div class="form-group row">
                  <label class="col-lg-12">File Excel</label>
                  <div class="col-lg-10" >
                      <input value="" id="uploadFile" class="form-control"  placeholder="Upload File Excel dengan format xlsx" readonly />
                  </div>
                  <div class="col-lg-2" >
                  
                     <div class="file-upload btn btn-block btn-success">		
                          <span><i class="fa fa-file"></i>&nbsp;&nbsp;<b>Pilih File</b></span>
                          <input  id="uploadBtn" name="file" type="file" class="upload"  />
                          
                      </div>
                  </div>
              </div>
                
                
                <button name="submit" type="submit" class="btn btn-primary "><i class="fa fa-check"></i> Upload</button>
                <button type="reset" class="btn btn-warning "><i class="fa fa-times"></i> Reset</button>
                </form>  
                
              </div>
            </div>
            
            
            
          </div>
          <!-- /.col-md-6 -->
      </div>
   
      
       
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
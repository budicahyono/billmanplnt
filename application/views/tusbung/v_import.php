

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
	  <div class="row">
         
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              
			  <div class="card-header">
                <h3 class="card-title"><i class=" fas fa-th-list mr-2"></i> Import Data Tusbung dan Pelanggan</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
             <div class="card-body">
               
                <form  action="<?=base_url('tusbung/post')?>" method="post" enctype="multipart/form-data">
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
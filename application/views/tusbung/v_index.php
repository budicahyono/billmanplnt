

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
	  <div class="row">
         
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              
			  <div class="card-header">
                <h3 class="card-title"><i class=" fas fa-th-list mr-2"></i>Monitoring Data Tusbung <?=bln_indo($_SESSION['bulan_sess'])?> <?=$_SESSION['tahun_sess']?></h3>

                <div class="card-tools">
                  
                    
                  <a onclick="return confirm('Apa anda yakin ingin menghapus tusbung <?=$nama_unit?> pada bulan <?=bln_indo($_SESSION['bulan_sess'])?> dan tahun <?=$_SESSION['tahun_sess']?>? ')" class="btn btn-danger btn-md" href="<?=base_url()?>tusbung/hapus/<?=$id_unit?>" ><i class="fa fa-trash"></i> Hapus Tusbung</a>
                    
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                 
				  </div> 
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                
                <div class="form-group">
                     <label>Unit</label> 
                <select id="id_unit" class="form-control" name="id_unit">
                 <?php foreach ($unit as $r) { 
                     if ($r['id_unit'] > 0) { 
                    ?>
                    <option value="<?=$r['id_unit']?>" <?php if ($id_unit == $r['id_unit']) echo "selected" ;?>><?=$r['nama_unit'].'&nbsp;&nbsp;&nbsp;(Data: '.$r['total_tul'].')'?></option>
                 <?php }} ?>
                 </select> 
               </div> 
                
                 
                 <table id="data_tusbung" class="table table-bordered table-hover ">
                  <thead class="text-center">
                  <tr >
                    <th rowspan=2 style="vertical-align:middle">NO</th> 
                    <th rowspan=2 style="vertical-align:middle">NAMA</th>
                    <th colspan=2>TUL TUSBUNG</th>
                    <th colspan=2>LUNAS</th>
                    <th colspan=2>BELUM LUNAS</th>
                    <th rowspan=2 style="vertical-align:middle">REALISASI PLG</th>
                    <th rowspan=2 style="vertical-align:middle">REALISASI RUPIAH</th>
                  </tr>
                  <tr >
                    <th >PLG</th> 
                    <th >RUPIAH</th>
                    
                    <th >PLG</th> 
                    <th >RUPIAH</th>
                    
                    <th >PLG</th> 
                    <th >RUPIAH</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php  $no=1;
                    foreach ($petugas as $r) {
                      if ($r['is_petugas_khusus'] == 0) {
                         include VIEWPATH."tusbung/v_list.php";
                        $no = $no + 1; 
                      }
                    }
                    foreach ($non_petugas as $r) {
                      include VIEWPATH."tusbung/v_list.php";  
                      $no++;
                    } if (count($petugas) == 0) { ?>
                    <tr>
                      <td colspan="6" class="text-center"><b>TIDAK ADA DATA</b></td>
                    </tr>	
                  <?php } ?>	
                  </tbody>
                   <tfoot> 
                  
                  <?php 
                    include VIEWPATH."tusbung/v_total.php";  
                      
                  ?>
                    
                  </tfoot>
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
    

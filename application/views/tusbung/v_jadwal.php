

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
	  <div class="row">
         
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              
			  <div class="card-header">
                <h3 class="card-title"><i class=" fas fa-th-list mr-2"></i>Monitoring Cetak Belum Lunas Berdasarkan Hari Baca <?=bln_indo($_SESSION['bulan_sess'])?> <?=$_SESSION['tahun_sess']?></h3>

                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#hari-baca" data-toggle="tab">Hari Baca</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#rupiah-baca" data-toggle="tab">Rupiah Baca</a>
                    </li>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                  </ul>
                  
                  
                  
				  </div> 
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                
                <div class="form-group">
                     <label>Unit</label> 
                <select id="id_unit_jadwal" class="form-control" name="id_unit">
                <option value="1" selected >MANOKWARI</option>
                 <?php foreach ($unit->result() as $r) { 
                     if ($r->id_unit > 1) { ?>
                    <option value="<?=$r->id_unit?>" <?php if ($id_unit == $r->id_unit) echo "selected" ;?>><?=$r->nama_unit?></option>
                 <?php }} ?>
                 </select> 
               </div> 
               
                 
                 <table id="data_tusbung" class="table table-bordered table-hover">
                  <thead class="text-center">
                  <tr >
                    <th>NO</th> 
                    <th>NAMA</th>
                    <th>A</th>
                    <th>B</th>
                    <th>C</th>
                    <th>D</th>
                    <th>E</th>
                    <th>F</th>
                    <th>G</th>
                    <th>H</th>
                    <th>I</th>
                    <th>TOTAL</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                  <?php  $no=1;
                    foreach ($petugas->result() as $r) {
                    if ($r->is_petugas_khusus == 0) {
                    
                    //ambil huruf A 
                    $sum_tul =  $this->M_Tusbung->get_tul_petugas($r->id_petugas, $id_unit)->num_rows(); 
                    
                  ?>	
                    <td><?=$no++?></td>
                    <td style="width:200px"><?=$r->nama_petugas?></td>
                    
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <th>Totals</th>
                    
                    <td style="width:100px">
                      <a  href="tusbung/detail_jadwal/<?php echo $r->id_petugas ?>?id_unit=<?=$id_unit?>" class="btn btn-info "><i class="fa fa-th-list"></i> Detail</a>
                       
                        
                    </td>
                  </tr>
                  <tr>
                  <?php  
                    }}
                    foreach ($non_petugas->result() as $r) {
                    if ($r->is_petugas_khusus == 0) {
                    
                  ?>	
                    <td><?=$no++?></td>
                    <td style="width:200px"><?=$r->nama_petugas?></td>
                    
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <th>Totals</th>
                    <td style="width:100px">
                      <a  href="tusbung/detail_jadwal/<?php echo $r->id_petugas ?>?id_unit=<?=$id_unit?>" class="btn btn-info "><i class="fa fa-th-list"></i> Detail</a>
                       
                        
                    </td>
                  </tr>
                  <?php $no++;}} if (count($petugas->result()) == 0) { ?>
                    <tr>
                      <td colspan="6" class="text-center"><b>TIDAK ADA DATA</b></td>
                    </tr>	
                  <?php } ?>	
                  </tbody>
                   <thead >
                  <tr >
                  <?php 
                  
               
                  ?>
                    <th class="text-center" colspan=2>TOTAL</th> 
                    
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <td>A</td>
                    <th>Totals</th>
                    <th class="text-center">Action</th>
                  </tr>
                  </thead>
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
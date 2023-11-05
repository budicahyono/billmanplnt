

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
	  <div class="row">
         
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              
			  <div class="card-header">
                <h3 class="card-title"><i class=" fas fa-th-list mr-2"></i> Monitoring Tusbung Harian <?=hari($hari).", ".$tgl_skrg?> <?=bln_indo($_SESSION['bulan_sess'])?> <?=$_SESSION['tahun_sess']?></h3>

                <div class="card-tools">
                  <a onclick="return confirm('Apa anda yakin ingin menghapus tusbung <?=$nama_unit?> pada <?=hari($hari).", ".$tgl_skrg?> <?=bln_indo($_SESSION['bulan_sess'])?> <?=$_SESSION['tahun_sess']?>? ')" class="btn btn-danger btn-md" href="<?=base_url()?>tusbungharian/hapus/<?=$id_unit?>?tgl=<?=$tgl_skrg?>" ><i class="fa fa-trash"></i> Hapus Tusbung Harian</a>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                 <form  action="<?=base_url('tusbungharian/post')?>" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                  <div class="col-lg-4">
                  <label>Tanggal</label>
                    <br/>
                    <select name="tanggal" id="tanggal_harian" class="form-control"  >
                      <option value="<?=$tgl_skrg?>">--Pilih Tanggal--</option>
                      <?php
                      
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
                <select class="form-control" name="id_unit" id="id_unit_harian">
                 <?php foreach ($unit->result() as $r) { 
                     if (!$r->id_unit == 0) { ?>
                    <option value="<?=$r->id_unit?>"><?=$r->nama_unit?></option>
                 <?php }} ?>
                 </select> 
               </div> 
                
                </form>
                
                <table id="data_tusbung" class="table table-bordered table-hover ">
                  <thead class="text-center">
                  <tr >
                    <th rowspan=2 style="vertical-align:middle">NO</th> 
                    <th rowspan=2 style="vertical-align:middle">NAMA</th>
                    <th colspan=2>PELANGGAN DICETAK</th>
                    <th colspan=2>LUNAS</th>
                    <th colspan=2 >REALISASI</th>
                    <th rowspan=2 style="vertical-align:middle">EVIDENCE</th>
                    <th rowspan=2 style="vertical-align:middle">TUL DIBAGIKAN</th>
                    <th rowspan=2 style="vertical-align:middle">SISA TUL</th>
                    <th rowspan=2 style="vertical-align:middle">KENDALA</th>
                  </tr>
                  <tr >
                    <th >TUL</th> 
                    <th >RUPIAH</th>
                    
                    <th >TUL</th> 
                    <th >RUPIAH</th>
                    
                    <th >PLG</th> 
                    <th >RP</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                  <?php  $no=1;
                    foreach ($petugas->result() as $r) {
                    
                    $sum_tul = $this->M_Tusbungharian->get_tul_petugas($r->id_petugas, $tgl_skrg)->num_rows();
                    
                    
                  ?>	
                    <td><?=$no++?></td>
                    <td style="width:200px"><?=$r->nama_petugas?></td>
                    
                    <td><?=$sum_tul?></td>
                    <td></td>
                    
                    <td></td>
                    <td></td>
                    
                    <td></td>
                    <td></td>
                    
                    <th></td>
                    <th></td>
                    <th></td>
                    <th></td>
                   
                  </tr>
                  
                  <?php } if (count($petugas->result()) == 0) { ?>
                    <tr>
                      <td colspan="6" class="text-center"><b>TIDAK ADA DATA</b></td>
                    </tr>	
                  <?php } ?>	
                  </tbody>
                   <tfoot> 
                  <tr >
                  <?php 
               
                  ?>
                    <th class="text-center" colspan=2 style="vertical-align:middle">TOTAL</th> 
                    
                    <th></th>
                    <th></th>
                    
                    <th></th>
                    <th></th>
                    
                    <th></th>
                    <th></th>
                    
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
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
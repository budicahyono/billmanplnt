

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
	  <div class="row">
         
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              
			  <div class="card-header">
                <h3 class="card-title"><i class=" fas fa-th-list mr-2"></i> Monitoring Petugas Tusbung Harian <?=hari($hari).", ".$tgl_skrg?> <?=bln_indo($_SESSION['bulan_sess'])?> <?=$_SESSION['tahun_sess']?></h3>

                <div class="card-tools">
                  <a onclick="return confirm('Apa anda yakin ingin menghapus tusbung harian <?=$nama_unit?> pada <?=hari($hari).", ".$tgl_skrg?> <?=bln_indo($_SESSION['bulan_sess'])?> <?=$_SESSION['tahun_sess']?> beserta kendala hariannya? ')" class="btn btn-danger btn-md" href="<?=base_url()?>tusbung_harian/hapus/<?=$id_unit?>?tgl=<?=$tgl_skrg?>" ><i class="fa fa-trash"></i> Hapus Tusbung Harian</a>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                 <form  action="<?=base_url('tusbung_harian/post')?>" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                  <div class="col-lg-4">
                  <label>Tanggal</label>
                    <br/>
                    <select name="tanggal" id="tanggal_petugas" class="form-control"  >
                      <option value="<?=$tgl_skrg?>">--Pilih Tanggal--</option>
                      <?php
                      
                      
                      foreach ($tgl_rows as $r){
                        if ($tgl_skrg == $r['tgl']) {
                          echo '<option value="'.$r['tgl'].'" selected>'.$r['tgl'].' &nbsp;&nbsp;&nbsp;(Data: '.$r['sum_tgl'].')</option>';
                        } else {
                          echo '<option value="'.$r['tgl'].'">'.$r['tgl'].' &nbsp;&nbsp;&nbsp;(Data: '.$r['sum_tgl'].')</option>';
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
                <select class="form-control" name="id_unit" id="id_unit_petugas">
                 <?php foreach ($unit->result() as $r) { 
                     if (!$r->id_unit == 0) { ?>
                    <option value="<?=$r->id_unit?>" <?php if ($id_unit == $r->id_unit) echo "selected" ;?>><?=$r->nama_unit?></option>
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
                    <th rowspan=2 style="vertical-align:middle">KENDALA HARIAN</th>
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
                  
                  <?php  $no=1;
                  $total_tul        = 0;
                  $total_rp         = 0;
                  $total_lunas      = 0;
                  $total_lunas_rp   = 0;
                  $total_persen     = 0;
                  $total_persen_rp  = 0;
                  $total_persen_rp  = 0;
                  $total_evidence   = 0;
                  $total_sisa       = 0;
                  foreach ($petugas as $r) {
                    if ($r['is_petugas_khusus'] == 0) {
                        include VIEWPATH."tusbung_harian/v_list.php";
                        $no = $no + 1; 
                    }
                  } 
                  foreach ($petugas_khusus as $r) { 
                    include VIEWPATH."tusbung_harian/v_list.php";
                    $no = $no + 1;
                  } if (count($petugas) == 0 and count($petugas_khusus) == 0) { ?>
                    <tr>
                      <td colspan="6" class="text-center"><b>TIDAK ADA DATA</b></td>
                    </tr>	
                  <?php } ?>	
                  </tbody>
                   <tfoot> 
                  <tr >
                  <?php 
                    if ($total_tul > 0 and $total_lunas > 0) {
                      $total_persen = round($total_lunas / $total_tul * 100, 1);
                    }
                    
                    if ($total_rp > 0 and $total_lunas_rp > 0) {
                      $total_persen_rp = round($total_lunas_rp / $total_rp * 100, 1);
                    }
                    
                    if ($total_tul > 0 and $total_evidence > 0) {
                        $total_persen_evidence = round($total_evidence / $total_tul * 100, 1);
                    }
                   
                  ?>
                    <th class="text-center" colspan=2 style="vertical-align:middle">TOTAL</th> 
                    
                    <th><a href="javascript:void(0)" id="tul_total"   data-sum="<?=$total_tul?>" data-jenis="tul" ><?=$total_tul?></a></th>
                    <th><?=rp($total_rp)?></th>
                    
                    <th><a href="javascript:void(0)" id="lunas_total"   data-sum="<?=$total_lunas?>" data-jenis="lunas" ><?=$total_lunas?></th>
                    <th><?=rp($total_lunas_rp)?></th>
                    
                    <th><?=$total_persen?>%</th>
                    <th><?=$total_persen_rp?>%</th>
                    
                    <th><?=$total_evidence?></th>
                    <th><?=$total_persen_evidence?>%</th>
                    <th><?=$total_sisa?></th>
                    <th>Total</th>
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


<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
	  <div class="row">
         
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              
			  <div class="card-header">
                <h3 class="card-title"><i class=" fas fa-th-list mr-2"></i> Monitoring Tusbung Harian <?=hari($hari).", ".$tgl_skrg?> <?=bln_indo($_SESSION['bulan_sess'])?> <?=$_SESSION['tahun_sess']?></h3>

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
                    <select name="tanggal" id="tanggal_harian" class="form-control"  >
                      <option value="<?=$tgl_skrg?>">--Pilih Tanggal--</option>
                      <?php
                      
                      $bln_skrg = $_SESSION['bulan_sess'];
					  $thn_skrg = $_SESSION['tahun_sess'];
                      
                      
                      
                      
                     $jumlah_tanggal = cal_days_in_month(CAL_GREGORIAN, $bln_skrg, $thn_skrg);
                      for ($i=1;$i<=$jumlah_tanggal;$i++){
                        $sum_tgl = $this->M_Tusbung->get_by_tgl($id_unit, $i)->num_rows();
                        if ($tgl_skrg == $i) {
                          echo '<option value="'.$i.'" selected>'.$i.' &nbsp;&nbsp;&nbsp;(Data: '.$sum_tgl.')</option>';
                        } else {
                          echo '<option value="'.$i.'">'.$i.' &nbsp;&nbsp;&nbsp;(Data: '.$sum_tgl.')</option>';
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
                  $total_tul = 0;
                  $total_rp = 0;
                  $total_lunas = 0;
                  $total_lunas_rp = 0;
                  $total_persen = 0;
                  $total_persen_rp = 0;
                  $total_evidence = 0;
                  $total_persen_evidence = 0;
                  $total_sisa = 0;
                  foreach ($petugas->result() as $r) {
                  
                    $sum_tul = $this->M_Tusbung->get_by_tgl_petugas($r->id_petugas, $id_unit, $tgl_skrg)->num_rows();
                    
                    $total_tul = $total_tul + $sum_tul;
                    
                     $sum_tul_rp = $this->M_Tusbung_Harian->get_tul_petugas_rp($r->id_petugas, $tgl_skrg);
                     foreach ($sum_tul_rp->result() as $row) {
						$sum_rp = $row->rptag;
					  } 
                      
                    $total_rp = $total_rp + $sum_rp;
                      
                    $sum_lunas = $this->M_Tusbung_Harian->get_lunas_petugas($r->id_petugas, $tgl_skrg)->num_rows();
                    
                    $total_lunas = $total_lunas + $sum_lunas;
                    
                    $sum_lunas_rp = $this->M_Tusbung_Harian->get_lunas_petugas_rp($r->id_petugas, $tgl_skrg);
                    foreach ($sum_lunas_rp->result() as $row) {
						$lunas_rp = $row->rptag;
                    } 
                      
                    $total_lunas_rp = $total_lunas_rp + $lunas_rp;  
                      
                    if ($sum_tul != 0 && $sum_lunas != 0) {
                        $persen_tul = round($sum_lunas / $sum_tul * 100, 1);
                    } else {
                        $persen_tul = 0;
                    }
                    
                    
                      
                    if ($sum_rp != 0 && $lunas_rp != 0) {
                        $persen_rp = round($lunas_rp / $sum_rp * 100, 1);
                    } else {
                        $persen_rp = 0;
                    }
                    
                    
                    
                    $sum_evidence = $this->M_Tusbung_Harian->get_evidence($r->id_petugas, $tgl_skrg)->num_rows();
                    
                    $total_evidence = $total_evidence + $sum_evidence; 
                    
                    if ($sum_tul != 0 && $sum_evidence != 0) {
                        $persen_evidence = round($sum_evidence / $sum_tul * 100, 1);
                    } else {
                        $persen_evidence = 0;
                    }
                    
                    
                    
                    $sisa_evidence = $sum_tul-$sum_evidence;
                    
                    $total_sisa = $total_sisa + $sisa_evidence;
                      
                    
                    $kendala_harian = $this->M_Kendala_Harian->get_kendala_harian($r->id_petugas, $tgl_skrg);
                    if ($kendala_harian->num_rows() > 0) {
                      foreach ($kendala_harian->result() as $row) {
                          $isi_kendala = $row->isi_kendala;
                          $id_kendala_harian = $row->id_kendala_harian;
                          $text_kendala = $row->isi_kendala;
                          
                      } 
                    } else {
                      $isi_kendala = null;
                      $id_kendala_harian = null;
                      $text_kendala = "<i style='color:red'>Belum diisi</i>";
                    }  
                    
                    
                    
                    
                    
                  ?>
                  <tr>
                    <td><?=$no?></td>
                    <td style="width:200px"><?=$r->nama_petugas?></td>
                    
                     <td><a href="javascript:void(0)" id="tul_<?=$no?>" data-name="<?=$r->nama_petugas?>" data-id="<?=$r->id_petugas?>" data-sum="<?=$sum_tul?>" data-jenis="tul" ><?=$sum_tul?></td>
                    <td><?="Rp ".number_format($sum_rp)?></td>
                    
                    <td><a href="javascript:void(0)" id="lunas_<?=$no?>" data-name="<?=$r->nama_petugas?>" data-id="<?=$r->id_petugas?>" data-sum="<?=$sum_lunas?>" data-jenis="lunas" ><?=$sum_lunas?></td>
                    <td><?="Rp ".number_format($lunas_rp)?></td>
                    
                    <td><?=$persen_tul?>%</td>
                    <td><?=$persen_rp?>%</td>
                    
                    <td><?=$sum_evidence?></td>
                    <td><?=$persen_evidence?>%</td>
                    <td><?=$sisa_evidence?></td>
                    <td>
                    <?php 
                    if ($sisa_evidence > 0) {
                      echo $text_kendala;
                      if ($isi_kendala == "") { ?>
                    <a  href="javascript:void(0)" id="save_kendala_<?=$r->id_petugas?>"   data-id="<?=$r->id_petugas?>" data-name="<?=$r->nama_petugas?>" data-edit="null" class="btn btn-danger " style="margin-left:10px"><i class="fa fa-edit"></i></a>   
                    
                    <?php } else { ?>
                    <a  href="javascript:void(0)" id="edit_kendala_<?=$r->id_petugas?>"   data-id="<?=$r->id_petugas?>" data-name="<?=$r->nama_petugas?>" data-edit="<?=$id_kendala_harian?>" class="btn btn-default " style="margin-left:10px"><i class="fa fa-edit"></i></a>   
                    
                    <?php }
                    } ?>
                    </td>
                   
                  </tr>
                  
                  <?php $no = $no + 1;} foreach ($petugas_khusus->result() as $r) { 
                      $id_petugas_khusus = $r->id_petugas;
                      $sum_tul = $this->M_Tusbung_Harian->get_tul_petugas(null, $tgl_skrg, $id_petugas_khusus)->num_rows();
                    
                    $total_tul = $total_tul + $sum_tul;
                    
                     $sum_tul_rp = $this->M_Tusbung_Harian->get_tul_petugas_rp(null, $tgl_skrg, $id_petugas_khusus);
                     foreach ($sum_tul_rp->result() as $row) {
						$sum_rp = $row->rptag;
					  } 
                      
                    $total_rp = $total_rp + $sum_rp;
                      
                    $sum_lunas = $this->M_Tusbung_Harian->get_lunas_petugas(null, $tgl_skrg, $id_petugas_khusus)->num_rows();
                    
                    $total_lunas = $total_lunas + $sum_lunas;
                    
                    $sum_lunas_rp = $this->M_Tusbung_Harian->get_lunas_petugas_rp(null, $tgl_skrg, $id_petugas_khusus);
                    foreach ($sum_lunas_rp->result() as $row) {
						$lunas_rp = $row->rptag;
                    } 
                      
                    $total_lunas_rp = $total_lunas_rp + $lunas_rp;  
                      
                    if ($sum_tul != 0 && $sum_lunas != 0) {
                        $persen_tul = round($sum_lunas / $sum_tul * 100, 1);
                    } else {
                        $persen_tul = 0;
                    }
                    
                    
                      
                    if ($sum_rp != 0 && $lunas_rp != 0) {
                        $persen_rp = round($lunas_rp / $sum_rp * 100, 1);
                    } else {
                        $persen_rp = 0;
                    }
                    
                    
                    
                    $sum_evidence = $this->M_Tusbung_Harian->get_evidence(null, $tgl_skrg, $id_petugas_khusus)->num_rows();
                    
                    $total_evidence = $total_evidence + $sum_evidence; 
                    
                    if ($sum_tul != 0 && $sum_evidence != 0) {
                        $persen_evidence = round($sum_evidence / $sum_tul * 100, 1);
                    } else {
                        $persen_evidence = 0;
                    }
                    
                   
                    
                    $sisa_evidence = $sum_tul-$sum_evidence;
                    
                    $total_sisa = $total_sisa + $sisa_evidence;
                      
                     $kendala_harian = $this->M_Kendala_Harian->get_kendala_harian(null, $tgl_skrg, $id_petugas_khusus);
                      if ($kendala_harian->num_rows() > 0) {
                        foreach ($kendala_harian->result() as $row) {
                            $isi_kendala = $row->isi_kendala;
                            $id_kendala_harian = $row->id_kendala_harian;
                            $text_kendala = $row->isi_kendala;
                            
                        } 
                      } else {
                        $isi_kendala = null;
                        $id_kendala_harian = null;
                        $text_kendala = "<i style='color:red'>Belum diisi</i>";
                      }  
                      
                  ?>
                  <tr>
                    <td><?=$no?></td>
                    <td style="width:200px"><?=$r->nama_petugas?> <?=($r->is_petugas_khusus == 1) ? "(Petugas Khusus)" : ""?></td>
                    
                    <td><a href="javascript:void(0)" id="tul_<?=$no?>" data-name="<?=$r->nama_petugas?>" data-id="<?=$id_petugas_khusus?>" data-sum="<?=$sum_tul?>" data-jenis="tul" ><?=$sum_tul?></td>
                    <td><?="Rp ".number_format($sum_rp)?></td>
                    
                    <td><a href="javascript:void(0)" id="lunas_<?=$no?>" data-name="<?=$r->nama_petugas?>" data-id="<?=$id_petugas_khusus?>" data-sum="<?=$sum_lunas?>" data-jenis="lunas" ><?=$sum_lunas?></td>
                    <td><?="Rp ".number_format($lunas_rp)?></td>
                    
                    <td><?=$persen_tul?>%</td>
                    <td><?=$persen_rp?>%</td>
                    
                    <td><?=$sum_evidence?></td>
                    <td><?=$persen_evidence?>%</td>
                    <td><?=$sisa_evidence?></td>
                    <td>
                    <?php 
                    if ($sisa_evidence > 0) {
                      echo $text_kendala;
                      if ($isi_kendala == "") { ?>
                    <a  href="javascript:void(0)" id="save_kendala_<?=$id_petugas_khusus?>"   data-id="<?=$id_petugas_khusus?>" data-name="<?=$r->nama_petugas?>" data-edit="null" class="btn btn-danger " style="margin-left:10px"><i class="fa fa-edit"></i></a>   
                    
                    <?php } else { ?>
                    <a  href="javascript:void(0)" id="edit_kendala_<?=$id_petugas_khusus?>"   data-id="<?=$id_petugas_khusus?>" data-name="<?=$r->nama_petugas?>" data-edit="<?=$id_kendala_harian?>" class="btn btn-default " style="margin-left:10px"><i class="fa fa-edit"></i></a>   
                    
                    <?php }
                    } ?>
                    </td>
                   
                  </tr>
                  <?php $no = $no + 1;} if (count($petugas->result()) == 0 and count($petugas_khusus->result()) == 0) { ?>
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
                    <th><?="Rp ".number_format($total_rp)?></th>
                    
                    <th><a href="javascript:void(0)" id="lunas_total"   data-sum="<?=$total_lunas?>" data-jenis="lunas" ><?=$total_lunas?></th>
                    <th><?="Rp ".number_format($total_lunas_rp)?></th>
                    
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
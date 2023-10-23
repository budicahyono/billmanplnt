<section class="content">
      <div class="container-fluid">
       

        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  DASHBOARD MONITORING TUNGGAKAN BILLMAN UP3 MANOKWARI - <?=strtoupper(bln_indo($_SESSION['bulan_sess']))?> <?=$_SESSION['tahun_sess']?>
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body" >
                
              
                <div class="row">
                  <div class="col-6">
                   <div class="card">
                      <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-money-bill mr-2"></i>Progres Lunas berdasarkan Rupiah</h3>

                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                          
                        </div>
                      </div>
                      <div class="card-body">
                        
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-2 col-md-6 text-center">
                              <div style="display:inline;width:90px;height:90px;">
                               <input type="text" class="knob" value="<?=$persen_bintuni_rp?>" data-width="90" data-height="90" data-fgcolor="#3c8dbc" data-readonly="true" readonly="readonly" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: rgb(60, 141, 188); padding: 0px; appearance: none;"></div> 

                              <div class="knob-label">BINTUNI</div>
                            </div> 
                            
                            <div class="col-lg-2 col-md-6 text-center">
                              <div style="display:inline;width:90px;height:90px;">
                                <input type="text" class="knob" value="<?=$persen_manokwari_rp?>" data-width="90" data-height="90" data-fgcolor="#3c8dbc" data-readonly="true" readonly="readonly" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: rgb(60, 141, 188); padding: 0px; appearance: none;"></div> 

                              <div class="knob-label">MANOKWARI</div>
                            </div> 
                            
                            <div class="col-lg-2 col-md-6 text-center">
                              <div style="display:inline;width:90px;height:90px;">
                                <input type="text" class="knob" value="<?=$persen_wasior_rp?>" data-width="90" data-height="90" data-fgcolor="#3c8dbc" data-readonly="true" readonly="readonly" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: rgb(60, 141, 188); padding: 0px; appearance: none;"></div> 

                              <div class="knob-label">WASIOR</div>
                            </div> 
                            
                           <div class="col-lg-2 col-md-6 text-center">
                              <div style="display:inline;width:90px;height:90px;">
                                <input type="text" class="knob" value="<?=$persen_prafi_rp?>" data-width="90" data-height="90" data-fgcolor="#3c8dbc" data-readonly="true" readonly="readonly" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: rgb(60, 141, 188); padding: 0px; appearance: none;"></div> 

                              <div class="knob-label">PRAFI</div>
                            </div> 
                            
                            <div class="col-lg-2 col-md-6 text-center">
                              <div style="display:inline;width:90px;height:90px;">
                                <input type="text" class="knob" value="<?=$persen_up3_rp?>" data-width="90" data-height="90" data-fgcolor="#bf2f2b" data-readonly="true" readonly="readonly" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: rgb(60, 141, 188); padding: 0px; appearance: none;"></div> 

                              <div class="knob-label">UP3</div>
                            </div> 
                          </div>
                          
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-6">
                   <div class="card">
                      <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-users mr-2"></i>Progres Lunas berdasarkan Pelanggan</h3>

                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                          
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-2 col-md-6 text-center">
                              <div style="display:inline;width:90px;height:90px;">
                                <input type="text" class="knob" value="<?=$persen_up3?>" data-width="90" data-height="90" data-fgcolor="#bf2f2b" data-readonly="true" readonly="readonly" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: rgb(60, 141, 188); padding: 0px; appearance: none;"></div> 

                              <div class="knob-label">UP3</div>
                            </div> 
                            
                            <div class="col-lg-2 col-md-6 text-center">
                              <div style="display:inline;width:90px;height:90px;">
                                <input type="text" class="knob" value="<?=$persen_manokwari?>" data-width="90" data-height="90" data-fgcolor="#3c8dbc" data-readonly="true" readonly="readonly" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: rgb(60, 141, 188); padding: 0px; appearance: none;"></div> 

                              <div class="knob-label">MANOKWARI</div>
                            </div> 
                            
                            <div class="col-lg-2 col-md-6 text-center">
                              <div style="display:inline;width:90px;height:90px;">
                               <input type="text" class="knob" value="<?=$persen_bintuni?>" data-width="90" data-height="90" data-fgcolor="#3c8dbc" data-readonly="true" readonly="readonly" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: rgb(60, 141, 188); padding: 0px; appearance: none;"></div> 

                              <div class="knob-label">BINTUNI</div>
                            </div> 
                            
                            
                            
                            <div class="col-lg-2 col-md-6 text-center">
                              <div style="display:inline;width:90px;height:90px;">
                                <input type="text" class="knob" value="<?=$persen_wasior?>" data-width="90" data-height="90" data-fgcolor="#3c8dbc" data-readonly="true" readonly="readonly" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: rgb(60, 141, 188); padding: 0px; appearance: none;"></div> 

                              <div class="knob-label">WASIOR</div>
                            </div> 
                            
                           <div class="col-lg-2 col-md-6 text-center">
                              <div style="display:inline;width:90px;height:90px;">
                                <input type="text" class="knob" value="<?=$persen_prafi?>" data-width="90" data-height="90" data-fgcolor="#3c8dbc" data-readonly="true" readonly="readonly" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: rgb(60, 141, 188); padding: 0px; appearance: none;"></div> 

                              <div class="knob-label">PRAFI</div>
                            </div> 
                            
                            
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                   <div class="card">
                      <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-th-list mr-2"></i>Jumlah Data</h3>

                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                          
                        </div>
                      </div>
                      <div class="card-body">
                        <table class="table table-bordered">
                          <tr>
                            <th>Unit</th>
                            <th>Total Pelanggan</th>
                            <th>Total Pelanggan Lunas</th>
                            <th>Total Rupiah</th>
                            <th>Total Rupiah Lunas</th>
                          </tr>
                          <tr>
                            <td>BINTUNI</td>
                            <td><?=$total_bintuni?></td>
                            <td><?=$lunas_bintuni?></td>
                            <td><?="Rp ".number_format($total_bintuni_rp)?></td>
                            <td><?="Rp ".number_format($lunas_bintuni_rp)?></td>
                          </tr>
                          <tr>
                            <td>MANOKWARI</td>
                            <td><?=$total_manokwari?></td>
                            <td><?=$lunas_manokwari?></td>
                            <td><?="Rp ".number_format($total_manokwari_rp)?></td>
                            <td><?="Rp ".number_format($lunas_manokwari_rp)?></td>
                          </tr>
                          <tr>
                            <td>WASIOR</td>
                            <td><?=$total_wasior?></td>
                            <td><?=$lunas_wasior?></td>
                            <td><?="Rp ".number_format($total_wasior_rp)?></td>
                            <td><?="Rp ".number_format($lunas_wasior_rp)?></td>
                          </tr>
                          <tr>
                            <td>PRAFI</td>
                            <td><?=$total_prafi?></td>
                            <td><?=$lunas_prafi?></td>
                            <td><?="Rp ".number_format($total_prafi_rp)?></td>
                            <td><?="Rp ".number_format($lunas_prafi_rp)?></td>
                          </tr>
                          <tr>
                            <td>UP3</td>
                            <td><?=$total_up3?></td>
                            <td><?=$lunas_up3?></td>
                            <td><?="Rp ".number_format($total_up3_rp)?></td>
                            <td><?="Rp ".number_format($lunas_up3_rp)?></td>
                          </tr>
                        </table>  
                      </div>
                    </div>
                  </div>
                </div>
              
                
              </div>
              <!-- /.card-body -->
            </div>
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

       

      

      </div><!-- /.container-fluid -->
    </section>
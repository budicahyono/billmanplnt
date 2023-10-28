

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
	  <div class="row">
         
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              
			  <div class="card-header">
                <h3 class="card-title"><i class=" fas fa-th-list mr-2"></i>Monitoring Data Tusbung <?=bln_indo($_SESSION['bulan_sess'])?> <?=$_SESSION['tahun_sess']?></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
				  </div> 
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <div class="form-group ">
							<a href="<?=base_url('tusbung?id_unit='.$id_unit)?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali</a>
						</div> 
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
      </div>
   
      
       
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
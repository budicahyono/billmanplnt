

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
	  <div class="row">
         
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              
			  <div class="card-header">
                <h3 class="card-title"><i class=" fas fa-th-list mr-2"></i> Data Petugas</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">

                <div class="form-group">
                  <a href="<?=base_url('petugas/tambah')?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Petugas</a>
                </div>
                <table id="data_paging" class="table table-bordered table-hover">
                  <thead>
                  <tr >
                    <th >No</th> 
                    <th >Nama Petugas</th>
                    <th >Username</th>
                    <th >Petugas Khusus?</th>
                    <th > <select class="form-control mini" name="id_unit" id="id_unit">
                     <?php foreach ($unit->result() as $r) {  ?>
                        <option value="<?=$r->id_unit?>" 
                        <?php
                        if (isset($id_unit)) {
                          if ($id_unit == $r->id_unit) echo "selected";
                        }
                        ?>
                        >UNIT <?=$r->nama_unit?></option>
                     <?php } ?>
                 </select></th>
                    <th >Last Login</th>
                    <th >Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                  <?php  $no=1;
                    foreach ($petugas->result() as $r) {
                    if ($r->id_unit > 0) { 
                  ?>	
                    <td><?=$no?></td>
                    <td><?=$r->nama_petugas?></td>
                    <td><?=$r->username?></td>
                    <td><?php if ($r->is_petugas_khusus == 1) { ?>
                      <h4><span class="badge badge-success ">Petugas Khusus</span></h4>
                    <?php } ?>
                      
                    </td>
                    <td><?=$r->nama_unit ?></td>
                   <td ><?php 
                        if ($r->last_login != "0000-00-00 00:00:00") {
                          echo tgl_indo($r->last_login);
                        } else {
                          echo "Belum Login";
                        }
                        ?>
                        </td>
                    <td style="width:200px">
                      <a  href="petugas/edit/<?php echo $r->id_petugas ?>" class="btn btn-info "><i class="fa fa-edit"></i> Edit</a>
                      <a  onclick="return confirm('Apa anda yakin ingin menghapusnya?')" href="petugas/hapus/<?php echo $r->id_petugas ?>" class="btn btn-danger "><i class="fa fa-trash"></i> Hapus</a>  
                        
                    </td>
                  </tr>
                  <?php 
$no++;
                    }} if (count($petugas->result()) == 0) { ?>
<tr>
<td colspan="6" class="text-center"><b>TIDAK ADA DATA</b></td>
</tr>	
<?php } ?>	
                  </tbody>
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
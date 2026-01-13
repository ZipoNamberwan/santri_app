<?php 
$this->db->order_by('id ASC');
$list_tujuan = $this->db->get('tujuan')->result_array();

?>
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Master Data</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
      <li class="breadcrumb-item">Master Data</li>
    </ol>
  </div>

  <div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Instansi</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="jml_ins"></span> Instansi</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <button type="submit" class="btn btn-sm btn-block btn-primary" data-toggle="modal" data-target="#modalIns">Lihat Daftar Instansi</button>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-building fa-2x text-primary"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Kantor BPS</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="jml_bps"></span> BPS</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <button type="submit" class="btn btn-sm btn-block btn-warning" data-toggle="modal" data-target="#modalBPS">Lihat Daftar Kantor BPS</button>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-landmark fa-2x text-warning"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah Layanan</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="jml_lay"></span> Layanan</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <button type="submit" class="btn btn-sm btn-block btn-info" data-toggle="modal" data-target="#modalLay">Lihat Daftar Layanan</button>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-concierge-bell fa-2x text-info"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Modal Instansi -->
  <div class="modal fade" id="modalIns" tabindex="-1" role="dialog" aria-labelledby="modalInsLabel" ria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalInsLabel">Daftar Instansi di Database</h5>
          <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalInsTambah" id="btn_mod_tbh_ins">Tambah Instansi</button>
        </div>
        <div class="modal-body">
          <div class="table-responsive pr-3 pl-3 pb-3 mt-0" id="tabel_instansi">
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Tambah Inst -->
  <div class="modal fade" id="modalInsTambah" tabindex="-1" role="dialog" aria-labelledby="modalInsTambahLabel" ria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title text-success" id="modalInsTambahLabel"><b>Tambah Instansi Baru</b></h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body row">
            <div class="col-sm-12">Nama Instansi</div>
              <div class="col-sm-12">
                <input class="form-control form-control-sm" type="text" id="nama_ins_tbh" name="nama_ins_tbh" required="" placeholder="">
              </div>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal"  class="btn btn-sm btn-outline-success">Cancel</button>
            <button type="button" class="btn btn-sm btn-success" id="btn_ins_tbh" disabled="">Tambah</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit Inst -->
  <div class="modal fade" id="modalInsEdit" tabindex="-1" role="dialog" aria-labelledby="modalInsEditLabel" ria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title text-primary" id="modalInsEditLabel"><b>Edit Instansi</b></h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body row">
            <div class="col-sm-12">Nama Instansi</div>
          	<div class="col-sm-12">
          		<input type="hidden" id="id_ins_edit" name="id_ins_edit">
            	<input class="form-control form-control-sm" type="text" id="nama_ins_edit" name="nama_ins_edit" required="" placeholder="">
          	</div>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal"  class="btn btn-sm btn-outline-primary">Cancel</button>
            <button type="button" class="btn btn-sm btn-primary" id="btn_ins_edit_sub" disabled="">Edit</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Delete Inst -->
  <div class="modal fade" id="modalInsDel" tabindex="-1" role="dialog" aria-labelledby="modalInsDelLabel" ria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title text-danger" id="modalInsDelLabel"><b>Delete Instansi</b></h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body row">
            <div class="col-sm-12">Nama Instansi</div>
          	<div class="col-sm-12">
          		<input type="hidden" id="id_ins_del" name="id_ins_del">
            	<span class="font-weight-bold" id="nama_ins_del"></span>
          	</div>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal"  class="btn btn-sm btn-outline-danger">Cancel</button>
            <button type="button" class="btn btn-sm btn-danger" id="btn_ins_del_sub">Delete</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal BPS -->
  <!-- Modal BPS -->
  <div class="modal fade" id="modalBPS" tabindex="-1" role="dialog" aria-labelledby="modalBPSLabel" ria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalBPSLabel">Daftar Kantor BPS di Database</h5>
          <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalBpsTambah" id="btn_mod_tbh_bps">Tambah Kantor BPS</button>
        </div>
        <div class="modal-body">
          <div class="table-responsive pr-3 pl-3 pb-3 mt-0" id="tabel_bps">
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Tambah Bps -->
  <div class="modal fade" id="modalBpsTambah" tabindex="-1" role="dialog" aria-labelledby="modalBpsTambahLabel" ria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title text-success" id="modalBpsTambahLabel"><b>Tambah Kantor BPS</b></h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body row">
            <div class="col-sm-12">
            	Kode BPS
            	<input class="form-control form-control-sm" type="number" id="kode_bps_tbh" name="kode_bps_tbh" required="" minlength="4" maxlength="4">
            </div>
            <div class="col-sm-12">
            	<br>Nama Kantor BPS
                <input class="form-control form-control-sm" type="text" id="nama_bps_tbh" name="nama_bps_tbh" required="" placeholder="">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal"  class="btn btn-sm btn-outline-success">Cancel</button>
            <button type="button" class="btn btn-sm btn-success" id="btn_bps_tbh" disabled="">Tambah</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit Bps -->
  <div class="modal fade" id="modalBpsEdit" tabindex="-1" role="dialog" aria-labelledby="modalBpsEditLabel" ria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title text-primary" id="modalBpsEditLabel"><b>Edit BPS</b></h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body row">
        	<div class="col-sm-12">
            	Kode BPS
            	<input type="hidden" id="id_bps_edit" name="id_bps_edit">
            	<input class="form-control form-control-sm" type="number" id="kode_bps_edit" name="kode_bps_edit" required="" minlength="4" maxlength="4">
            </div>
            <div class="col-sm-12">
            	<br>Nama Kantor BPS
                <input class="form-control form-control-sm" type="text" id="nama_bps_edit" name="nama_bps_edit" required="" placeholder="">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal"  class="btn btn-sm btn-outline-primary">Cancel</button>
            <button type="button" class="btn btn-sm btn-primary" id="btn_bps_edit_sub" disabled="">Edit</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Delete Bps -->
  <div class="modal fade" id="modalBpsDel" tabindex="-1" role="dialog" aria-labelledby="modalBpsDelLabel" ria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title text-danger" id="modalBpsDelLabel"><b>Delete Kantor BPS</b></h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body row">
            <div class="col-sm-12">Kantor BPS</div>
          	<div class="col-sm-12">
          		<input type="hidden" id="id_bps_del" name="id_bps_del">
            	<span class="font-weight-bold" id="nama_bps_del"></span>
          	</div>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal"  class="btn btn-sm btn-outline-danger">Cancel</button>
            <button type="button" class="btn btn-sm btn-danger" id="btn_bps_del_sub">Delete</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal Layanan -->
  <!-- Modal Layanan -->
  <div class="modal fade" id="modalLay" tabindex="-1" role="dialog" aria-labelledby="modalLayLabel" ria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLayLabel">Daftar Layanan di Database</h5>
          <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalLayTambah" id="btn_mod_tbh_lay">Tambah Layanan</button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
        	<div class="col-sm-3">Fungsi/Bagian</div>
        	<div class="col-sm-9">
        		<select class="form-control form-control-sm select2-tujuan" id="tujuan" name="tujuan" required="">
                  <?php for ($i=0; $i < count($list_tujuan); $i++) { 
                  	echo '<option value="'.$list_tujuan[$i]['id'].'">'.$list_tujuan[$i]['nama'].'</option>';
                  } ?>
	            </select>
        	</div>
          </div>
          <div class="table-responsive pr-3 pl-3 pb-3 mt-0" id="tabel_lay">
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Tambah Layanan -->
  <div class="modal fade" id="modalLayTambah" tabindex="-1" role="dialog" aria-labelledby="modalLayTambahLabel" ria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title text-success" id="modalLayTambahLabel"><b>Tambah Layanan</b></h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body row">
            <div class="col-sm-12">
            	Fungsi/Bagian
            	<select class="form-control form-control-sm" id="tujuan_lay_tbh" name="tujuan_lay_tbh" required="">
                  <?php for ($i=0; $i < count($list_tujuan); $i++) { 
                  	echo '<option value="'.$list_tujuan[$i]['id'].'">'.$list_tujuan[$i]['nama'].'</option>';
                  } ?>
	            </select>
            </div>
            <div class="col-sm-12">
            	<br>Nama Layanan
                <input class="form-control form-control-sm" type="text" id="nama_lay_tbh" name="nama_lay_tbh" required="" placeholder="">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal"  class="btn btn-sm btn-outline-success">Cancel</button>
            <button type="button" class="btn btn-sm btn-success" id="btn_lay_tbh" disabled="">Tambah</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit Layanan -->
  <div class="modal fade" id="modalLayEdit" tabindex="-1" role="dialog" aria-labelledby="modalLayEditLabel" ria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title text-primary" id="modalLayEditLabel"><b>Edit Layanan</b></h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body row">
        	<div class="col-sm-12">
            	Fungsi/Bagian
            	<input type="hidden" id="id_lay_edit" name="id_lay_edit">
            	<select class="form-control form-control-sm" id="tujuan_lay_edit" name="tujuan_lay_edit" required="">
                  <?php for ($i=0; $i < count($list_tujuan); $i++) { 
                  	echo '<option value="'.$list_tujuan[$i]['id'].'">'.$list_tujuan[$i]['nama'].'</option>';
                  } ?>
	            </select>
            </div>
            <div class="col-sm-12">
            	<br>Nama Layanan
                <input class="form-control form-control-sm" type="text" id="nama_lay_edit" name="nama_lay_edit" required="" placeholder="">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal"  class="btn btn-sm btn-outline-primary">Cancel</button>
            <button type="button" class="btn btn-sm btn-primary" id="btn_lay_edit_sub" disabled="">Edit</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Delete Layanan -->
  <div class="modal fade" id="modalLayDel" tabindex="-1" role="dialog" aria-labelledby="modalLayDelLabel" ria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title text-danger" id="modalLayDelLabel"><b>Delete Layanan</b></h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body row">
            <div class="col-sm-12">Fungsi/Bagian - Layanan</div>
          	<div class="col-sm-12">
          		<input type="hidden" id="id_lay_del" name="id_lay_del">
            	<span class="font-weight-bold" id="nama_lay_del"></span>
          	</div>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal"  class="btn btn-sm btn-outline-danger">Cancel</button>
            <button type="button" class="btn btn-sm btn-danger" id="btn_lay_del_sub">Delete</button>
        </div>
      </div>
    </div>
  </div>

</div>
<!---Container Fluid-->

<script src="<?php echo base_url(); ?>assets/radmin/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/radmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/radmin/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/radmin/vendor/select2/dist/js/select2.min.js"></script>
<!-- dataTableHover -->
<script src="<?php echo base_url(); ?>assets/radmin/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/radmin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
  	load_list_instansi();

  	function load_list_instansi(){
      // $('#tabel_instansi').html('loading... <i class="fas fa-spinner fa-pulse"></i>');
      
      $.ajax({
        url:"<?php echo base_url(); ?>master/list_instansi",
        method:"POST",
        data:{},
        success:function(data){
          var obj = jQuery.parseJSON(data);
          $('#jml_ins').html(obj.jml_ins);
          $('#tabel_instansi').html(obj.list_ins);
        }
      })
      
    }


    //tambah instansi
    $('#btn_mod_tbh_ins').click(function(){
    	$('#nama_ins_tbh').val('');
    	document.getElementById("btn_ins_tbh").disabled = true;
    });

    $('#nama_ins_tbh').keyup(function(){
    	var nama = $("#nama_ins_tbh").val();
    	var ln = nama.length;

    	if (ln>2) { document.getElementById("btn_ins_tbh").disabled = false; }
    	else { document.getElementById("btn_ins_tbh").disabled = true; }
    });

    $('#btn_ins_tbh').click(function(){
    	var nama = $("#nama_ins_tbh").val();
	   	$.ajax({
	        url:"<?php echo base_url(); ?>master/tambah_instansi",
	        method:"POST",
	        data:{nama:nama},
	        success:function(data){
	          $('#nama_ins_tbh').val('');
    		  document.getElementById("btn_ins_tbh").disabled = true;
	          load_list_instansi();
	          Swal.fire( 'Sukses', 'Berhasil tambah Instansi', 'success' );
	        }
	    })
    });


    //edit instansi
    $('#nama_ins_edit').keyup(function(){
    	var nama = $("#nama_ins_edit").val();
    	var ln = nama.length;

    	if (ln>2) { document.getElementById("btn_ins_edit_sub").disabled = false; }
    	else { document.getElementById("btn_ins_edit_sub").disabled = true; }
    });

    $('#btn_ins_edit_sub').click(function(){
    	var id = $("#id_ins_edit").val();
    	var nama = $("#nama_ins_edit").val();
	   	$.ajax({
	        url:"<?php echo base_url(); ?>master/edit_instansi",
	        method:"POST",
	        data:{id:id,nama:nama},
	        success:function(data){
    		  $('#modalInsEdit').modal('hide');
    		  document.getElementById("btn_ins_edit_sub").disabled = true;
	          load_list_instansi();
	          Swal.fire( 'Sukses', 'Berhasil edit Instansi', 'success' );
	        }
	    })
    });

    //hapus instansi
    $('#btn_ins_del_sub').click(function(){
    	var id = $("#id_ins_del").val();
	   	$.ajax({
	        url:"<?php echo base_url(); ?>master/hapus_instansi",
	        method:"POST",
	        data:{id:id},
	        success:function(data){
    		  $('#modalInsDel').modal('hide');
	          load_list_instansi();
	          Swal.fire( 'Sukses', 'Instansi berhasil dihapus', 'success' );
	        }
	    })
    });

  });

</script>

<script type="text/javascript">
  $(document).ready(function(){
  	load_list_bps();

  	function load_list_bps(){
      $.ajax({
        url:"<?php echo base_url(); ?>master/list_bps",
        method:"POST",
        data:{},
        success:function(data){
          var obj = jQuery.parseJSON(data);
          $('#jml_bps').html(obj.jml_bps);
          $('#tabel_bps').html(obj.list_bps);
        }
      })
      
    }

    //tambah BPS
    $('#btn_mod_tbh_bps').click(function(){
    	$('#kode_bps_tbh').val('');
    	$('#nama_bps_tbh').val('');
    	document.getElementById("btn_bps_tbh").disabled = true;
    });

    $('#kode_bps_tbh').keyup(function(){
    	disable_btn_tbh_bps();
    });

     $('#nama_bps_tbh').keyup(function(){
    	disable_btn_tbh_bps();
    });

    function disable_btn_tbh_bps(){
    	var nama = $("#nama_bps_tbh").val();
    	var kode = $("#kode_bps_tbh").val();
    	var ln = nama.length;
    	var lk = kode.length;

    	if (ln>5 && lk==4) { document.getElementById("btn_bps_tbh").disabled = false; }
    	else { document.getElementById("btn_bps_tbh").disabled = true; }
    }

    $('#btn_bps_tbh').click(function(){
    	var kode = $("#kode_bps_tbh").val();
    	var nama = $("#nama_bps_tbh").val();
	   	$.ajax({
	        url:"<?php echo base_url(); ?>master/tambah_bps",
	        method:"POST",
	        data:{kode:kode,nama:nama},
	        success:function(data){
	          $('#nama_bps_tbh').val('');
	          $('#kode_bps_tbh').val('');
    		  document.getElementById("btn_bps_tbh").disabled = true;

    		  var obj = jQuery.parseJSON(data);
    		  if (obj.s == 1) {
    		  	load_list_bps();
	          	Swal.fire( 'Sukses', 'Berhasil tambah Kantor BPS', 'success' );
    		  } else {
	          	Swal.fire( 'Info', obj.m, 'info' );
    		  }
	          
	        }
	    })
    });


    //edit bps
    $('#kode_bps_edit').keyup(function(){
    	disable_btn_edit_bps();
    });

    $('#nama_bps_edit').keyup(function(){
    	disable_btn_edit_bps();
    });

    function disable_btn_edit_bps(){
    	var nama = $("#nama_bps_edit").val();
    	var kode = $("#kode_bps_edit").val();
    	var ln = nama.length;
    	var lk = kode.length;

    	if (ln>5 && lk==4) { document.getElementById("btn_bps_edit_sub").disabled = false; }
    	else { document.getElementById("btn_bps_edit_sub").disabled = true; }
    }

    $('#btn_bps_edit_sub').click(function(){
    	var id = $("#id_bps_edit").val();
    	var kode = $("#kode_bps_edit").val();
    	var nama = $("#nama_bps_edit").val();
	   	$.ajax({
	        url:"<?php echo base_url(); ?>master/edit_bps",
	        method:"POST",
	        data:{id:id,kode:kode,nama:nama},
	        success:function(data){
    		  $('#modalBpsEdit').modal('hide');
    		  document.getElementById("btn_bps_edit_sub").disabled = true;

    		  var obj = jQuery.parseJSON(data);
    		  if (obj.s == 1) {
    		  	load_list_bps();
	          	Swal.fire( 'Sukses', 'Berhasil edit Kantor BPS', 'success' );
    		  } else {
	          	Swal.fire( 'Info', obj.m, 'info' );
    		  }
	        }
	    })
    });

    //hapus instansi
    $('#btn_bps_del_sub').click(function(){
    	var id = $("#id_bps_del").val();
	   	$.ajax({
	        url:"<?php echo base_url(); ?>master/hapus_bps",
	        method:"POST",
	        data:{id:id},
	        success:function(data){
    		  $('#modalBpsDel').modal('hide');
	          load_list_bps();
	          Swal.fire( 'Sukses', 'Kantor BPS berhasil dihapus', 'success' );
	        }
	    })
    });

  });

</script>

<script type="text/javascript">
  $(document).ready(function(){
  	load_list_layanan();

  	// $('.select2-tujuan').select2({
   //      placeholder: "Pilih Fungsi/Bagian",
   //      allowClear: false
   //  });

    $('#tujuan').change(function(){
    	load_list_layanan();
    });

  	function load_list_layanan(){
  	  var tujuan = $("#tujuan").val();

      $.ajax({
        url:"<?php echo base_url(); ?>master/list_layanan",
        method:"POST",
        data:{tujuan:tujuan},
        success:function(data){
          var obj = jQuery.parseJSON(data);
          $('#jml_lay').html(obj.jml_lay);
          $('#tabel_lay').html(obj.list_lay);
          $('#tujuan_lay_tbh').val(tujuan);
          $('#tujuan_lay_edit').val(tujuan);
        }
      })
    }


    //tambah BPS
    $('#btn_mod_tbh_lay').click(function(){
    	var tujuan = $("#tujuan").val();

    	$('#tujuan_lay_tbh').val(tujuan);
    	$('#nama_lay_tbh').val('');
    	document.getElementById("btn_lay_tbh").disabled = true;
    });

    $('#nama_lay_tbh').keyup(function(){
    	var nama = $("#nama_lay_tbh").val();
    	var ln = nama.length;

    	if (ln>2) { document.getElementById("btn_lay_tbh").disabled = false; }
    	else { document.getElementById("btn_lay_tbh").disabled = true; }
    });

    $('#btn_lay_tbh').click(function(){
    	var tujuan = $("#tujuan_lay_tbh").val();
    	var nama = $("#nama_lay_tbh").val();
	   	$.ajax({
	        url:"<?php echo base_url(); ?>master/tambah_layanan",
	        method:"POST",
	        data:{tujuan:tujuan,nama:nama},
	        success:function(data){
	          $('#nama_lay_tbh').val('');
    		  document.getElementById("btn_lay_tbh").disabled = true;

    		  var obj = jQuery.parseJSON(data);
    		  if (obj.s == 1) {
    		  	load_list_layanan();
	          	Swal.fire( 'Sukses', 'Berhasil tambah Layanan', 'success' );
    		  } else {
	          	Swal.fire( 'Info', obj.m, 'info' );
    		  }
	          
	        }
	    })
    });


    //edit layanan
    $('#tujuan_lay_edit').change(function(){
    	disable_btn_edit_bps();
    });

    $('#nama_lay_edit').keyup(function(){
    	disable_btn_edit_bps();
    });

    function disable_btn_edit_bps(){
    	var nama = $("#nama_lay_edit").val();
    	var ln = nama.length;

    	if (ln>2) { document.getElementById("btn_lay_edit_sub").disabled = false; }
    	else { document.getElementById("btn_lay_edit_sub").disabled = true; }
    }

    $('#btn_lay_edit_sub').click(function(){
    	var id = $("#id_lay_edit").val();
    	var tujuan = $("#tujuan_lay_edit").val();
    	var nama = $("#nama_lay_edit").val();
	   	$.ajax({
	        url:"<?php echo base_url(); ?>master/edit_layanan",
	        method:"POST",
	        data:{id:id,tujuan:tujuan,nama:nama},
	        success:function(data){
    		  $('#modalLayEdit').modal('hide');
    		  document.getElementById("btn_lay_edit_sub").disabled = true;

    		  var obj = jQuery.parseJSON(data);
    		  if (obj.s == 1) {
    		  	load_list_layanan();
	          	Swal.fire( 'Sukses', 'Berhasil edit Layanan', 'success' );
    		  } else {
	          	Swal.fire( 'Info', obj.m, 'info' );
    		  }
	        }
	    })
    });

    //hapus layanan
    $('#btn_lay_del_sub').click(function(){
    	var id = $("#id_lay_del").val();
	   	$.ajax({
	        url:"<?php echo base_url(); ?>master/hapus_layanan",
	        method:"POST",
	        data:{id:id},
	        success:function(data){
    		  $('#modalLayDel').modal('hide');
	          load_list_layanan();
	          Swal.fire( 'Sukses', 'Layanan berhasil dihapus', 'success' );
	        }
	    })
    });

  });

</script>
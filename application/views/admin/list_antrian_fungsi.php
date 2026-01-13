<?php 
$this->db->where('id', $tujuan);
$nmtujuan = $this->db->get('tujuan')->row_array();
if (is_null($nmtujuan)) { $nmtujuan = ''; } else { $nmtujuan = $nmtujuan['nama']; }

?>
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Antrian <?php echo $nmtujuan; ?></h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
      <li class="breadcrumb-item">Daftar Antrian</li>
    </ol>
  </div>

  <div class="row">
    <div class="col-xl-6 col-md-6 mb-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col ml-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Tanggal</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <input type="date" class="form-control form-control-sm" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d') ?>">
                <input type="hidden" id="tujuan" name="tujuan" value="<?php echo $tujuan ?>">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-2 col-md-2 mb-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col ml-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Reservasi</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800" id="jml_rev"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-2 col-md-2 mb-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col ml-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">On Spot</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800" id="jml_on"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-2 col-md-2 mb-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col ml-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Total</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800" id="jml_tot"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-12">
      <div class="card mb-3">
        <div class="table-responsive pr-3 pl-3 pb-3 mt-0" id="tabel_antrian">
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" ria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDetailLabel">No Antrian : <span id="mod_kode"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table style="width: 100%;font-size: 90%;">
            <tr><td>Tanggal</td>      <td>:</td>  <td style="width: 70%;" id="tbl_tanggal"></td></tr>
            <tr><td>Jam</td>          <td>:</td>  <td style="width: 70%;" id="tbl_jam"></td></tr>
            <tr><td>Tujuan</td>       <td>:</td>  <td style="width: 70%;" id="tbl_tujuan"></td></tr>
            <tr><td>Nama</td>         <td>:</td>  <td style="width: 70%;" id="tbl_nama"></td></tr>
            <tr><td>Email</td>        <td>:</td>  <td style="width: 70%;" id="tbl_email"></td></tr>
            <tr><td>No HP</td>        <td>:</td>  <td style="width: 70%;" id="tbl_hp"></td></tr>
            <tr><td>Instansi</td>     <td>:</td>  <td style="width: 70%;" id="tbl_instansi"></td></tr>
            <tr><td>Keperluan</td>    <td>:</td>  <td style="width: 70%;" id="tbl_keperluan"></td></tr>
            <tr><td>Progres</td>      <td>:</td>  <td style="width: 70%;" id="tbl_progres"></td></tr>
            <tr><td>Process By</td>   <td>:</td>  <td style="width: 70%;" id="tbl_processby"></td></tr>
            <tr>
              <td style="vertical-align:top;">Log</td><td style="vertical-align:top;">:</td>  <td style="width: 70%;" id="tbl_log"></td>
            </tr>
          </table>
        </div>
        <div class="modal-footer" id="form_foot" style="display:none;">
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalProcess" tabindex="-1" role="dialog" aria-labelledby="modalProcessLabel" ria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalProcessLabel">Confirm Process</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table style="width: 100%;font-size: 90%;">
            <tr><td>Kode</td> <td>:</td>  <td style="width: 70%;" id="proc_kode"></td></tr>
            <tr><td>Nama</td> <td>:</td>  <td style="width: 70%;" id="proc_nama"></td></tr>
          </table>
        </div>
        <div class="modal-footer">
          <form method="POST" action="<?php echo base_url(); ?>admin/process" enctype="multipart/form-data">
            <input type="hidden" id="proc_qr" name="qr_code" value="">
            <input type="hidden" id="process_by" name="process_by" value="<?php echo $session['username'] ?>">
            <button type="button" data-dismiss="modal"  class="btn btn-outline-success">Cancel</button>
            <button type="submit" class="btn btn-success">Confirm</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalFinish" tabindex="-1" role="dialog" aria-labelledby="modalFinishLabel" ria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalFinishLabel">Confirm Finish</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table style="width: 100%;font-size: 90%;">
            <tr><td>Kode</td> <td>:</td>  <td style="width: 70%;" id="fin_kode"></td></tr>
            <tr><td>Nama</td> <td>:</td>  <td style="width: 70%;" id="fin_nama"></td></tr>
          </table>
        </div>
        <div class="modal-footer">
          <form method="POST" action="<?php echo base_url(); ?>admin/finish" enctype="multipart/form-data">
            <input type="hidden" id="fin_qr" name="qr_code" value="">
            <button type="button" data-dismiss="modal"  class="btn btn-outline-primary">Cancel</button>
            <button type="submit" class="btn btn-primary">Confirm</button>
          </form>
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

<script type="text/javascript">
  $(document).ready(function(){
  	load_list_antrian();

    $('#tanggal').change(function(){
    	load_list_antrian();
    });

  	function load_list_antrian(){
      $('#tabel_antrian').html('loading... <i class="fas fa-spinner fa-pulse"></i>');
      var tanggal = $("#tanggal").val();
      var tujuan = $("#tujuan").val();
      
      $.ajax({
        url:"<?php echo base_url(); ?>admin/list_antrian",
        method:"POST",
        data:{tanggal:tanggal,tujuan:tujuan},
        success:function(data){
          var obj = jQuery.parseJSON(data);
          $('#jml_rev').html(obj.jml_rev);
          $('#jml_on').html(obj.jml_on);
          $('#jml_tot').html(obj.jml_tot);
          $('#tabel_antrian').html(obj.list);
        }
      })
      
    }

  });

</script>
<?php 
$this->db->order_by('id ASC');
$list_tujuan = $this->db->get('tujuan')->result_array();
?>
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar User</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
      <li class="breadcrumb-item">Daftar User</li>
    </ol>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="card mb-3">

        <?php if ($session['role'] == 1) { ?>
        <div class="pr-3 pl-3 pt-3">
          <button type="button" class="btn btn-sm btn-success mb-1 float-right" data-toggle="modal" data-target="#modalTambah">Tambah User</button>
        </div>
        <?php } ?>
        
        <input type="hidden" id="tujuan_h" name="tujuan_h" value="<?php echo $tujuan ?>">
        <div class="table-responsive pr-3 pl-3 pb-3 mt-0" id="tabel_users">
        </div>
      </div>
    </div>
  </div>

  <?php if ($session['role'] == 1) { ?>
  <!-- Modal Tambah -->
  <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" ria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahLabel">Tambah User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="<?php echo base_url(); ?>users/tambah" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-sm-3">Username</div>
              <div class="col-sm-4">
                <input class="form-control form-control-sm" type="text" id="username" name="username" required="" placeholder="Username">
              </div>
              <div class="col-sm-2">Role</div>
              <div class="col-sm-3">
                <select class="form-control form-control-sm" id="role" name="role" required="">
                  <option value="">Pilih</option>
                  <option value="1">Admin</option>
                  <option value="2">User Fungsi/Bagian</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-3">Nama</div>
              <div class="col-sm-9">
                <input class="form-control form-control-sm" type="text" id="nama" name="nama" required="" placeholder="Nama Lengkap">
              </div>
            </div>

            <div class="form-group row" id="div_tujuan" style="display:none;">
              <div class="col-sm-3">Fungsi/Bagian</div>
              <div class="col-sm-9">
                <select class="form-control form-control-sm select2-tujuan" id="tujuan" name="tujuan" required="">
                  <option value="">Pilih Fungsi/Bagian</option>
                  <?php for ($i=0; $i < count($list_tujuan); $i++) { 
                    echo '<option value="'.$list_tujuan[$i]['id'].'">'.$list_tujuan[$i]['nama'].'</option>';
                  } ?>
                </select>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal"  class="btn btn-outline-success">Cancel</button>
            <button type="submit" class="btn btn-success">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- Modal Edit -->
  <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" ria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditLabel">Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="<?php echo base_url(); ?>users/edit" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-sm-3">Username</div>
              <div class="col-sm-4">
                <span id="username_ed_txt"></span>
                <input type="hidden" id="username_ed" name="username" value="">
              </div>
              <div class="col-sm-2">Role</div>
              <div class="col-sm-3">
                <select class="form-control form-control-sm" id="role_ed" name="role" required="">
                  <option value="">Pilih</option>
                  <option value="1">Admin</option>
                  <option value="2">User Fungsi/Bagian</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-3">Nama</div>
              <div class="col-sm-9">
                <input class="form-control form-control-sm" type="text" id="nama_ed" name="nama" required="" value="" placeholder="Nama Lengkap">
              </div>
            </div>

            <div class="form-group row" id="div_tujuan_ed">
              <div class="col-sm-3">Fungsi/Bagian</div>
              <div class="col-sm-9">
                <select class="form-control form-control-sm select2-tujuan" id="tujuan_ed" name="tujuan" required="">
                  <option value="">Pilih Fungsi/Bagian</option>
                  <?php for ($i=0; $i < count($list_tujuan); $i++) { 
                    echo '<option value="'.$list_tujuan[$i]['id'].'">'.$list_tujuan[$i]['nama'].'</option>';
                  } ?>
                </select>
              </div>
            </div>
          </div>

          <div class="modal-body row">
            <div class="col-md-6">
              <button type="button" class="btn btn-outline-danger" data-dismiss="modal" data-toggle="modal" data-target="#modalDelete">Delete</button>
              <button type="button" class="btn btn-outline-warning" data-dismiss="modal" data-toggle="modal" data-target="#modalReset">Reset Password</button>
            </div>
            <div class="col-md-6 text-right">
              <button type="button" data-dismiss="modal" class="btn btn-outline-primary">Cancel</button>
              <button type="submit" class="btn btn-primary">Edit</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>

  <!-- Modal Delete -->
  <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" ria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDeleteLabel">Delete User "<b><span id="username_del_txt"></span></b>"</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="<?php echo base_url(); ?>users/delete" enctype="multipart/form-data">
          <div class="modal-footer">
            <input type="hidden" id="username_del" name="username" value="">
            <button type="button" data-dismiss="modal"  class="btn btn-outline-danger">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Reset -->
  <div class="modal fade" id="modalReset" tabindex="-1" role="dialog" aria-labelledby="modalResetLabel" ria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalResetLabel">Reset Password User "<b><span id="username_res_txt"></span></b>"</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="<?php echo base_url(); ?>users/reset" enctype="multipart/form-data">
          <div class="modal-footer">
            <input type="hidden" id="username_res" name="username" value="">
            <button type="button" data-dismiss="modal"  class="btn btn-outline-warning">Cancel</button>
            <button type="submit" class="btn btn-warning">Reset</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php } ?>

</div>
<!---Container Fluid-->

<script src="<?php echo base_url(); ?>assets/radmin/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/radmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/radmin/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/radmin/vendor/select2/dist/js/select2.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
  	load_list_users();

    // $('.select2-tujuan').select2({
    //     placeholder: "Pilih Tujuan",
    //     allowClear: false
    // });

  	function load_list_users(){
      $('#tabel_users').html('loading... <i class="fas fa-spinner fa-pulse"></i>');
      var tujuan = $("#tujuan_h").val();

      $.ajax({
        url:"<?php echo base_url(); ?>users/list_users",
        method:"POST",
        data:{tujuan:tujuan},
        success:function(data){
         $('#tabel_users').html(data);
        }
      })
      
    }


    //tambah
    $('#role').change(function(){
      var role = $("#role").val();
      if (role == 1) {
        document.getElementById("div_tujuan").style.display = 'none';
        document.getElementById("tujuan").required = false;
        $("#tujuan").val('');
      } else {
        document.getElementById("div_tujuan").style.display = '';
        document.getElementById("tujuan").required = true;
      }
    });

    //edit
    $('#role_ed').change(function(){
      var role = $("#role_ed").val();
      if (role == 1) {
        document.getElementById("div_tujuan_ed").style.display = 'none';
        document.getElementById("tujuan_ed").required = false;
        $("#tujuan_ed").val('');
      } else {
        document.getElementById("div_tujuan_ed").style.display = '';
        document.getElementById("tujuan_ed").required = true;
      }
    });

  });

</script>